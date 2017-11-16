<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SupplyOrder extends Model
{
    //
    public $timestamps=false;
    public $table= 'supply-orders';

    public function storeinfo(){
        return $this->belongsTo('App\Model\MemberStoreinfo','member_id','member_id');
    }

    public function supply()
    {
        return $this->belongsTo('App\Model\Supply','supplys_id');
    }
}
