<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MemberStoreinfo extends Model
{
    //
    public $timestamps = false;
    public $table = 'member-storeinfo';

    public function supplys()
    {

    }

    public function member()
    {
        return $this->belongsTo('App\Model\Member' , 'member_id');
    }
    public function userinfo()
    {
        return $this->belongsTo('App\Model\MemberUserinfo','member_id','mid');
    }

}
