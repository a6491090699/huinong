<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SupplyAttr extends Model
{
    //
    public $table ="supply-attr";
    public $timestamps = false;
    protected $fillable = [
        'good_attr_id',
        'attribute_id',
        'supplys_id',
        'attr_value',
    ];


    static public function getSupplyAttr($sid)
    {
        return self::where('supplys_id' , $sid)->get();
    }

    public function attrs()
    {
        // return $this->belongsTo('App\Model\Attribute');
        return $this->belongsTo('App\Model\Attribute' ,'attribute_id');
    }
}
