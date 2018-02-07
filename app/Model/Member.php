<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    //
    public $fillable = [];

    public $table = 'member';
    public $timestamps = false;
    public function supplyOrder()
    {
        return $this->hasManyThrough('\App\Model\SupplyOrder','\App\Model\Supply','member_id','supplys_id');
    }

    public function memberinfo()
    {
        return $this->hasOne('\App\Model\MemberUserinfo','mid');
    }

    //用户默认的地址
    public function defaultaddr()
    {
        return $this->hasOne('\App\Model\MemberAddress','mid')->where('is_default','1');
    }

    public function store()
    {
        return $this->hasOne('\App\Model\MemberStoreinfo','member_id');

    }
}
