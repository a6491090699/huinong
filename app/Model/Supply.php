<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Supply extends Model
{
    //
    public $timestamps = false;

    public $fillable = [
        'id',
        'name',
        'price',
        'number',
        'cutday',
        'source',
        'kid',
        'member_id',
        'addtime',
        'imgs',
        'is_emergency' ,
        'status'
    ];
    public $table = 'supplys';

    static public function getMemberSupply($mid , $type = 'array')
    {
        $data = self::where('member_id' , $mid)->get();
        if($type == 'array') return $data->toArray();
        if($type == 'json') return $data->toJson();

    }

    public function supplyAttrs(){
        return $this->hasMany('App\Model\SupplyAttr' , 'supplys_id' );

    }

    public function kinds(){
        return $this->belongsTo('App\Model\Kind','kid');
    }

    public function member(){
        return $this->belongsTo('App\Model\Member');
    }

    public function orders(){
        return $this->hasMany('App\Model\SupplyOrder' ,'supplys_id');
    }


}
