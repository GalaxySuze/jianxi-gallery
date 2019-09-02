<?php

namespace App\Console\Commands;

use App\Models\WhWorks;
use App\Support\DownloadPicture;
use App\Support\Tool;
use App\Traits\CmdOutput;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use QL\QueryList;

class Wallhaven extends Command
{
    use CmdOutput;

    const TEST_NOT = 0;
    const TEST_LIST = 1;
    const TEST_DETAIL = 2;

    /**
     * @var
     */
    public $download;
    /**
     * @var string
     */
    protected $signature = 'crawler:wallhaven {page=1 : 抓取的总页数} {url=https://wallhaven.cc/toplist : 抓取的页面链接} {--T|test=0 : 是否开启测试}';
    /**
     * @var string
     */
    protected $description = 'wallhaven图片爬虫';

    /**
     * Wallhaven constructor.
     * @param DownloadPicture $downloadPicture
     */
    public function __construct(DownloadPicture $downloadPicture)
    {
        parent::__construct();
        $this->download = $downloadPicture;
    }

    /**
     * 处理程序
     */
    public function handle()
    {
        try {
            $this->comment('🚀启动爬虫...');

            // 默认分页
            $pagination = 1;
            $page = $this->argument('page');
            $url = $this->argument('url');
            $isTest = $this->option('test');

            // 页面抓取规则
            $rules = [
                'code'       => ['.thumb', 'data-wallpaper-id'],
                'cover'      => ['.thumb > img', 'data-src'],
                'img_link'   => ['.thumb .preview', 'href'],
                'star'       => ['.thumb .thumb-info .wall-favs', 'text'],
                'resolution' => ['.thumb .thumb-info .wall-res', 'text'],
            ];

            // 详情页抓取规则
            $worksRules = [
                'author'            => ['.sidebar-content > div[data-storage-id="showcase-info"] .username', 'text'],
                'colors'            => ['.sidebar-content .color-palette', 'html'],
                'upload_time'       => ['.sidebar-content > div[data-storage-id="showcase-info"] time', 'title'],
                'original_category' => ['.sidebar-content > div[data-storage-id="showcase-info"] dd:eq(1)', 'text'],
                'size'              => ['.sidebar-content > div[data-storage-id="showcase-info"] dd:eq(2)', 'html'],
                'views'             => ['.sidebar-content > div[data-storage-id="showcase-info"] dd:eq(3)', 'html'],
                'tags'              => ['.sidebar-content > div[data-storage-id="showcase-tags"] #tags', 'html'],
                'picture'           => ['main > #showcase .scrollbox #wallpaper', 'src'],
            ];

            // 抓取元素切片
            $range = '#thumbs .thumb-listing-page > ul > li';

            if ($isTest != self::TEST_NOT) {
                return $this->testUnit([$rules, $worksRules, $range], $isTest);
            }

            for ($p = $pagination; $p <= $page; $p++) {

                $this->comment("开始抓取 [$p] 个列表...");

                $worksList = QueryList::get($url, ['page' => $p])
                    ->rules($rules)
                    ->range($range)
                    ->queryData(function ($item) {
                        // 不重复下载已经记录了图片
                        $item['exist'] = WhWorks::where('org_code', $item['code'])->exists();
                        if (!$item['exist']) {
                            return $this->download
                                ->setResources($item)
                                ->savePicture($item['code']);
                        }
                        return $item;
                    });

                $this->info("第 [$pagination] 页列表抓取完毕...");

                Log::info('works_list_data:', $worksList);

                $this->comment("开始抓取图片详情...");

                // 抓取作品图片
                $detailQL = QueryList::getInstance();
                foreach ($worksList as &$v) {
                    $this->info("抓取 [ {$v['code']} ] 图片...");
                    try {
                        if ($v['exist']) {
                            $this->line("[ {$v['code']} ] 已经下载过,跳过抓取...");
                            continue;
                        }
                        if (empty($v['img_link'])) {
                            $this->error("[ {$v['code']} ] 详情链接为空,跳过抓取...");
                            continue;
                        }
                        $worksURL = $v['img_link'];
                        $workRes = $detailQL->get($worksURL)
                            ->rules($worksRules)
                            ->queryData(function ($item) use ($v) {
                                // 分析tags
                                $tagsQL = QueryList::html($item['tags']);
                                $item['tags'] = $tagsQL->find('.tagname')->map(function ($tj) {
                                    return $tj->text();
                                })->all();

                                // 分析colors
                                $tagsQL = QueryList::html($item['colors']);
                                $item['colors'] = $tagsQL->find('.color')->map(function ($cj) {
                                    return Str::after($cj->attr('style'), 'background-color:');
                                })->all();

                                // 下载图片
                                return $this->download
                                    ->setResources($item)
                                    ->savePicture($v['code']);
                            });

                        if (!isset($workRes[0]) || empty($workRes)) {
                            $this->error("[ {$v['code']} ] 详情页面分析结果为空,跳过抓取...");
                            continue;
                        }

                        $v = array_merge($v, $workRes[0]);

                        Log::info('works_all_data:', $v);

                        $this->info("写入数据库...");

                        // 过滤下格式
                        Tool::filterFormat($v);

                        // 记录到数据库
                        WhWorks::updateOrCreate([
                            'org_code' => $v['code'],
                            'author'   => $v['author'],
                        ], [
                            'cover'           => $v['cover_path'],
                            'img'             => $v['picture_path'],
                            'colors'          => $v['colors'],
                            'tags'            => $v['tags'],
                            'resolution'      => $v['resolution'],
                            'author'          => $v['author'],
                            'size'            => $v['size'],
                            'org_code'        => $v['code'],
                            'org_cover_link'  => $v['cover'],
                            'org_img_link'    => $v['picture'],
                            'org_star'        => $v['star'],
                            'org_upload_time' => $v['upload_time'],
                            'org_category'    => $v['original_category'],
                            'org_views'       => $v['views'],
                        ]);

                        $this->comment("图片 [ {$v['code']} ] 抓取完毕...");
                    } catch (\Throwable $worksEx) {
                        $this->echoErr("图片 [ {$v['code']} ] 抓取发生错误", $worksEx);
                    }
                }

                $this->comment("第 [$p] 个列表处理结束...");
            }

        } catch (\Throwable $e) {
            $this->echoErr("发生异常", $e);
        }
    }

    /**
     * @param $rule
     * @param $type
     */
    public function testUnit($rule, $type)
    {
        list($rules, $worksRules, $range) = $rule;
        switch ($type) {
            case self::TEST_LIST:
                $testHtml = file_get_contents(public_path('test/list.txt'));
                break;
            case self::TEST_DETAIL:
                $testHtml = file_get_contents(public_path('test/detail.txt'));
                break;
            default:
                $testHtml = null;
        }

        $data = null;
        if ($type == self::TEST_LIST) {
            $data = QueryList::rules($rules)->range($range)->html($testHtml)->query()->getData();
        }
        if ($type == self::TEST_DETAIL) {
            $data = QueryList::rules($worksRules)->html($testHtml)->query()->getData();
        }
        dd($data);

    }
}
