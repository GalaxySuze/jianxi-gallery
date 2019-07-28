<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GkWorks extends Model
{
    use SoftDeletes;

    protected $table = 'gk_works';

    protected $guarded = [
        'updated_at',
        'created_at',
        'deleted_at',
    ];

    protected $casts = [
        'tags' => 'array',
    ];
}
