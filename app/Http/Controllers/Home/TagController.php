<?php

namespace App\Http\Controllers\Home;

use App\Models\WhTag;
use App\Support\Tool;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    // 随机显示标签数
    const RANDOM_TAG_NUM = 3;

    public function __construct()
    {

    }

    public static function getRandomWhTag()
    {
        return self::instance()->displayArray(
            WhTag::getRandomWhTagData(self::RANDOM_TAG_NUM)
        );

    }

    /**
     * @param $data
     * @return array
     */
    public function displayArray($data): array
    {
        return $data->map(function ($v) {
            $item = [
                'color' => Tool::getRandomColor(),
                'name'  => $v['tag_name_zh'],
            ];
            return $item;
        })->all();
    }

    /**
     * @return TagController
     */
    protected static function instance()
    {
        return new static();
    }
}
