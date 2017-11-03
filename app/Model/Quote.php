<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    //
    public $timestamps = false;

    public $fillable = [
        'id',
        'member_id',
        'status',
        'price',
        'number',
        'beihuo',
        'fapiao_type',
        'addtime',
        'wants_id',
    ];
    public function wants(){
        return $this->belongsTo('App\Model\Want','wants_id');
    }


}
