<?php

namespace App\Models;

use App\Http\Controllers\Home\IndexController;
use App\Support\Tool;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WhWorks extends Model
{
    use SoftDeletes;

    const PROCESS_TYPE_TAG = 1;
    const PROCESS_TYPE_RESOLUTION = 2;
    const DEFAULT_PAGES = 12;

    protected $table = 'wh_works';

    protected $guarded = [
        'updated_at',
        'created_at',
        'deleted_at',
    ];

    protected $casts = [
        'tags'   => 'array',
        'colors' => 'array',
    ];

    /**
     * @return array
     */
    public static function getProcessType()
    {
        return [
            self::PROCESS_TYPE_TAG,
            self::PROCESS_TYPE_RESOLUTION,
        ];
    }

    /**
     * @param int $page
     * @return mixed
     */
    public static function getWhWorksData($page = self::DEFAULT_PAGES)
    {
        return WhWorks::paginate($page)->toArray();
    }

    /**
     * @param $value
     * @return string
     */
    public function getCoverAttribute($value)
    {
        return Tool::setStoragePath($value);
    }

    /**
     * @param $value
     * @return string
     */
    public function getImgAttribute($value)
    {
        return Tool::setStoragePath($value);
    }
}
