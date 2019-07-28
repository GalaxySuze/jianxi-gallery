<?php

namespace App\Console\Commands;

use App\Models\GkWorks;
use App\Models\GkWorksImg;
use App\Support\Tool;
use App\Traits\CmdOutput;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use QL\QueryList;

class GraffitiKingdom extends Command
{
    use CmdOutput;
    /**
     * @var string
     */
    protected $signature = 'crawler:graffiti-kingdom';

    /**
     * @var string
     */
    protected $description = '涂鸦王国图片爬取命令';

    /**
     * GraffitiKingdom constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * handle
     */
    public function handle()
    {
        try {
            $this->comment('开始抓取目标链接 [ https://www.gracg.com/works/index/type/essence/hdid/0/page/分页数 ]...');
            // 默认分页
            $pagination = 1;

            // 页面抓取规则
            $rules = [
                'title'            => ['.infobox .titles', 'text'],
                'works_num'        => ['.imgbox .tool .worknum', 'text'],
                'works_url'        => ['.imgbox > a', 'href'],
                'cover'            => ['.imgbox > a > img', 'src'],
                'read'             => ['.infobox .hpw_see', 'text'],
                'like'             => ['.infobox .hpw_love', 'text'],
                'comment'          => ['.infobox .hpw_pl', 'text'],
                'avatar'           => ['.userinfo > a > img', 'src'],
                'author'           => ['.userinfo .name', 'text'],
                'homepage'         => ['.userinfo > a', 'href'],
                'release_time_str' => ['.userinfo > .time', 'text'],
                'tags'             => ['.infobox .tags', 'html'],
            ];

            $worksRules = [
                'img' => ['.workPage-images', 'html'],
            ];

            // 抓取元素切片
            $range = '.TheWorksList > li';

            $this->comment('开始抓取分页页面...');
            for ($i = $pagination; $i <= 1; $i++) {
                $this->info("开始第 [$i] 页...");
                try {
                    // 爬取链接
                    $url = "https://www.gracg.com/works/index/type/essence/hdid/0/page/$i/";
                    // 抓取列表
                    $worksList = QueryList::get($url)
                        ->rules($rules)
                        ->range($range)
                        ->queryData(function ($item) {
                            $ql = QueryList::html($item['tags']);
                            $item['tags'] = $ql->find('a')->map(function ($j) {
                                return $j->text();
                            })->all();

                            // works_num 为空就设为0
                            $item['works_num'] = empty($item['works_num']) ? 0 : $item['works_num'];
                            return $item;
                        });

                    $this->info("第 [$i] 页列表抓取完毕...");

                    $this->comment("开始抓取作品详情...");

                    // 抓取作品图片
                    foreach ($worksList as $k => &$v) {
                        $this->info("抓取 [ {$v['title']} ] 作品...");
                        try {
                            $seqNo = $k + 1;
                            if (empty($v['works_url'])) {
                                continue;
                            }
                            $worksURL = $v['works_url'];
                            $works = QueryList::get($worksURL)
                                ->rules($worksRules)
                                ->queryData(function ($item) {
                                    // 抓取作品下载链接
                                    $imgQ = QueryList::html($item['img']);
                                    $imgSrc = $imgQ
                                        ->find('img')
                                        ->map(function ($imgItem) {
                                            return $imgItem->src;
                                        })->all();
                                    $hrefSrc = $imgQ
                                        ->find('a')
                                        ->map(function ($aItem) {
                                            return $aItem->href;
                                        })->all();
                                    $item['img'] = compact('imgSrc', 'hrefSrc');
                                    return $item;
                                })[0];

                            $v['works_list'] = $works;

                            $this->comment("准备写入数据库...");

                            DB::beginTransaction();
                            // 记录到数据库
                            $record = GkWorks::updateOrCreate([
                                'author' => $v['author'],
                                'title'  => $v['title'],
                            ], [
                                'title'            => $v['title'],
                                'cover'            => $v['cover'],
                                'works_url'        => $v['works_url'],
                                'works_num'        => $v['works_num'],
                                'read'             => $v['read'],
                                'like'             => $v['like'],
                                'comment'          => $v['comment'],
                                'avatar'           => $v['avatar'],
                                'author'           => $v['author'],
                                'homepage'         => $v['homepage'],
                                'release_time_str' => $v['release_time_str'],
                                'tags'             => $v['tags'],
                                'platform'         => 1,
                            ]);

                            foreach ($works as $imgK => $imgItem) {
                                $imgSrc = data_get($imgItem, 'imgSrc', []);
                                $hrefSrc = data_get($imgItem, 'hrefSrc', []);
                                if (!empty($imgSrc)) {
                                    foreach ($imgSrc as $ik => $iv) {
                                        $iSeqNo = $ik + 1;
                                        $imgSave['seq_no'] = $iSeqNo;
                                        $imgSave['image'] = $iv;
                                        $imgSave['hd_image'] = $hrefSrc[$ik] ?? null;
                                        GkWorksImg::updateOrCreate([
                                            'works_id' => $record->id,
                                            'seq_no'   => $iSeqNo,
                                        ], $imgSave);
                                    }
                                }
                            }

                            DB::commit();

                            $this->info("第 [$seqNo] 个作品 [ {$v['title']} ] 抓取完毕...");
                        } catch (\Throwable $worksEx) {
                            DB::rollBack();
                            $this->echoErr("第 [$seqNo] 个作品 [ {$v['title']} ] 抓取发生错误", $worksEx);
                        }
                    }
                } catch (\Throwable $ex) {
                    $this->echoErr("第 [{$i}] 页抓取发生错误", $ex);
                }
            }
        } catch (\Throwable $e) {
            $this->echoErr("请求异常", $e);
        }
    }
}
