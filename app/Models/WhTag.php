<?php

namespace App\Models;

use App\Support\Tool;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WhTag extends Model
{
    /**
     * 然删除
     */
    use SoftDeletes;

    protected $table = 'wh_tag';

    protected $guarded = [
        'updated_at',
        'created_at',
        'deleted_at',
    ];

    /**
     * @param $limit
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function getRandomWhTagData($limit)
    {
        $query = WhTag::query();

        if ($limit) {
            $query = $query->offset(Tool::getRandomNumber())->limit($limit);
        }

        return $query->get(['tag_name_zh']);
    }
}
