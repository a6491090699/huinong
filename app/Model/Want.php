<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Want extends Model
{
    //
    protected $fillable = [
        'source' ,
        'title' ,
        'number',
        'gaodu' ,
        'mijing' ,
        'dijing' ,
        'guanfu' ,
        'imgs' ,
        'tip' ,
        'is_emergency' ,
        'cutday' ,
        'status',
        'kid',
        'member_id',
        'addtime'
    ];

    
}
