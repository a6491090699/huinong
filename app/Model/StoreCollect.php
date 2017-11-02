<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class StoreCollect extends Model
{
    //
    public $table = 'store-collect';
    public $timestamps = false;
    protected fillable = [
        'member_id'.
        'store_id'.
    ];

    static public function getMemberCollect($mid)
    {
        return self::where('member_id' , $mid)->get();
    }

    static public function getStoreCollectNum($store_id)
    {
        return self::where('store_id' , $store_id)->count();
    }
}
