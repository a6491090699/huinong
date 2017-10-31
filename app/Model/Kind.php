<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Kind extends Model
{
    //
    protected $fillable = [
        'id' ,
        'name' ,
        'pid' ,

    ];

    public $timestamps =false;

    static public function getJsonList(){
        $data = self::where('pid',0)->get()->toArray();

        foreach ($data as $key=>$val){

            $pid = $val['pid'];
            $get = self::where('pid' ,$pid)->get()->toArray();

            if(!empty($get)) $data[$key]['child'] =$get;


        }
        dd($data);
    }

    static public function loopsome($array=array()){

        $data = self::where('pid',0)->get()->toArray();

        foreach ($data as $key=>$val){

            $pid = $val['pid'];
            $get = self::where('pid' ,$pid)->get()->toArray();

            if(!empty($get)) $data[$key]['child'] =$get;


        }
        dd($data);
    }

    public function getChild($array=array() ,$pid , $type = 'array')
    {
        foreach($array as $key =>$val){
            if(isset($val['child']) && is_array($val['child']));
        }
        $res =  self::where('pid' , $pid)->get()->toArray();
    }


}
