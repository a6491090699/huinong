<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class WantAttr extends Model
{
    //
    public $table ="want-attr";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'good_attr_id',
        'attribute_id',
        'wants_id',
        'attr_value',
    ];


    static public function getWantAttr($wid)
    {
        return self::where('wants_id' , $wid)->get();
    }

    public function attrs()
    {
        // return $this->belongsTo('App\Model\Attribute');
        return $this->belongsTo('App\Model\Attribute' ,'good_attr_id');
    }

}
