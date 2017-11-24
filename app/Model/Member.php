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
}
