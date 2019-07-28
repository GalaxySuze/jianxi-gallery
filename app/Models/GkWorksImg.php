<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GkWorksImg extends Model
{
    public $timestamps = false;

    protected $table = 'gk_works_img';

    protected $fillable = [
        'works_id',
        'seq_no',
        'hd_image',
        'image',
    ];
}
