<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class StoreCollect extends Model
{
    //
    public $table = 'store-collect';
    public $timestamps = false;
    protected $fillable = [
        'member_id',
        'store_id',
    ];

    static public function getMemberCollect($mid)
    {
        return self::where('member_id' , $mid)->get();
    }

    static public function getStoreCollectNum($store_id)
    {
        return self::where('store_id' , $store_id)->count();
    }

    public function stores()
    {
        return $this->belongsTo('App\Model\MemberStoreinfo','store_id');
    }

    public function goods()
    {
        //  $this->hasManyThrough('App\Post', 'App\User', 'country_id', 'user_id', 'id');
        return $this->hasMany('App\Model\Supply', 'member_id', 'store_id');
    }

}
