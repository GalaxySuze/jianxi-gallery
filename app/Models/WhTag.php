<?php

namespace App\Models;

use App\Support\Tool;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WhTag extends Model
{
    use SoftDeletes;

    protected $table = 'wh_tag';

    protected $guarded = [
        'updated_at',
        'created_at',
        'deleted_at',
    ];

    /**
     * @param $limit
     * @return array
     */
    public static function getRandomWhTagData($limit)
    {
        $query = WhTag::query();
        if ($limit) {
            $query = $query->offset(Tool::getRandomNumber())
                ->limit($limit);
        }
        return $query->get(['tag_name_zh'])
            ->map(function ($v) {
                $item = [
                    'color' => Tool::getRandomColor(),
                    'name'  => $v['tag_name_zh'],
                ];
                return $item;
            })->all();
    }
}
