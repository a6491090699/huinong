<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    //
    public $table ="attribute";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'attr_name',
        'attr_input_type',
        'attr_values',
        'unit',
        'kinds_id',

    ];

    public function kinds()
    {
        return $this->belongsTo('App\Model\Kind');

    }
}
