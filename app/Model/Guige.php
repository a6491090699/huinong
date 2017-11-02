<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Guige extends Model
{
    //
    protected $fillable = [
        'id' ,
        'kinds_id' ,
        'name' ,

    ];
    public $timestamps =false;
    public $table ='guige';

}
