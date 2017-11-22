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
        'imgs' ,
        'tip' ,
        'is_emergency' ,
        'cutday' ,
        'status',
        'kid',
        'member_id',
        'addtime',
        'phone',
        'address',
    ];


    public $timestamps = false;

    static public function getMemberWant($mid , $type = 'array')
    {
        $data = self::where('member_id' , $mid)->get();
        if($type == 'array') return $data->toArray();
        if($type == 'json') return $data->toJson();

    }

    public function wantAttrs(){
        return $this->hasMany('App\Model\WantAttr' , 'wants_id' );

    }

    public function kinds(){
        return $this->belongsTo('App\Model\Kind','kid');
    }

    public function member(){
        return $this->belongsTo('App\Model\Member');
    }

    public function quotes(){
        return $this->hasMany('App\Model\Quote' ,'wants_id');
    }

    public function address(){
        return $this->belongsTo('App\Model\MemberAddress' ,'address_id');
    }


}
