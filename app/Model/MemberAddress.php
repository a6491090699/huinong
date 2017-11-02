<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MemberAddress extends Model
{
    //
    protected $fillable = [
        'id',
        'city',
        'province',
        'tel',
        'phone',
        'part',
        'street',
        'mid',

    ];
    protected $table = 'member-address';
    public $timestamps = false;



    static public function getAddress($mid = 0 ,$type = 'array')
    {

        $data = self::where('mid',$mid)->get();
        if($type == 'json') return $data->toJson();
        if($type == 'array') return $data->toArray();
        
    }


}
