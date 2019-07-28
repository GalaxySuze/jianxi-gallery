<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WhResolution extends Model
{
    use SoftDeletes;

    protected $table = 'wh_resolution';

    protected $guarded = [
        'updated_at',
        'created_at',
        'deleted_at',
    ];

    /**
     * @return WhResolution[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function getResolutionData()
    {
        return WhResolution::all(['id', 'resolution']);
    }
}
