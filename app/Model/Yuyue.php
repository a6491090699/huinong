<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Yuyue extends Model
{
    //
    public $timestamps =false;


    public function supply()
    {
        return $this->belongsTo('App\Model\Supply' , 'supplys_id');
    }

    public function storeinfo(){
        return $this->belongsTo('App\Model\MemberStoreinfo','member_id','member_id');
    }

}
