<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SupplyOrder extends Model
{
    //
    public $timestamps=false;
    public $table= 'supply-orders';

    public function storeinfo(){
        return $this->belongsTo('App\Model\MemberStoreinfo','store_member_id','member_id');
    }

    public function supply()
    {
        return $this->belongsTo('App\Model\Supply','supplys_id');
    }
    public function orderfight()
    {
        return $this->hasOne('App\Model\OrderFight','supply_orders_id');
    }
    public function userinfo()
    {
        return $this->hasOne('App\Model\MemberUserinfo','mid','member_id');
    }
}
