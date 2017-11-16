<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class GoodCollect extends Model
{
    //
    public $table = 'good-collect';
    public $timestamps = false;
    protected $fillable = [
        'member_id',
        'good_id'
    ];

    static public function getMemberCollect($mid)
    {
        return self::where('member_id' , $mid)->get();
    }

    static public function getGoodCollectNum($gid)
    {
        return self::where('good_id' , $gid)->count();
    }

    public function goods()
    {
        return $this->belongsTo('App\Model\Supply','good_id');
    }

    


}
