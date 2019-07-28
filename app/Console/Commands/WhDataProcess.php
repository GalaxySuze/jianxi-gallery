<?php

namespace App\Console\Commands;

use App\Models\WhResolution;
use App\Models\WhTag;
use App\Models\WhWorks;
use App\Models\WhWorksTag;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class WhDataProcess extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'process:wh-data-process {type : 加工类型}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '对爬取的数据进行加工';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $type = $this->argument('type');
        if (!in_array($type, WhWorks::getProcessType())) {
            $this->error('请输入正确的加工类型...');
            die();
        }

        $data = WhWorks::all([
            'tags',
            'resolution',
            'id',
        ]);

        if ($type == WhWorks::PROCESS_TYPE_TAG) {
            $tagList = [];
            foreach ($data->toArray() as $t) {
                $itemTags = $t['tags'];
                $tagList[] = $itemTags;

                foreach ($itemTags as $tagName) {
                    // 标签存在才更新
                    $exist = WhTag::where('tag_name_en', Str::title($tagName))->first();
                    if ($exist) {
                        if (!WhWorksTag::where('works_id', $t['id'])->where('tag_id', $exist->id)->first()) {
                            WhWorksTag::create([
                                'tag_id'   => $exist->id,
                                'works_id' => $t['id'],
                            ]);
                        }
                    }
                }
            }
            // 更新tags
            collect($tagList)->flatten()->unique()->map(function ($i) {
                $name = Str::title($i);
                WhTag::updateOrCreate([
                    'tag_name_en' => $name,
                ], [
                    'tag_name_zh' => $name,    // TODO: 待翻译
                    'tag_name_en' => $name,
                ]);
            });
            $this->comment('标签更新完毕...');
        }

        if ($type == WhWorks::PROCESS_TYPE_RESOLUTION) {
            // 更新分辨率
            $data->pluck('resolution', 'id')->map(function ($v, $k) {
                $exist = WhResolution::where(['resolution' => $v])->first();
                if (!$exist) {
                    WhResolution::create([
                        'resolution' => $v,
                    ]);
                }
                if ($exist) {
                    WhWorks::where('id', $k)->update([
                        'resolution_id' => $exist->id,
                    ]);
                }
            });
            $this->comment('分辨率更新完毕...');
        }
    }
}
