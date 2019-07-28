<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhWorksTag extends Model
{
    protected $table = 'wh_works_tag';

    public $timestamps = false;

    protected $fillable = [
        'tag_id',
        'works_id',
    ];
}
