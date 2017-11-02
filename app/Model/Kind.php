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

    
    static public function listToTree($pk='id', $pid = 'pid', $child = 'child', $root = 0)
    {
        $list = self::all()->toArray();

        $tree = array();

        if(is_array($list)) {
            // 创建基于主键的数组引用
            $refer = array();
            foreach ($list as $key => $data) {
                $refer[$data[$pk]] =& $list[$key];
            }
            foreach ($list as $key => $data) {
                // 判断是否存在parent
                $parentId =  $data[$pid];
                if ($root == $parentId) {
                    $tree[] =& $list[$key];
                }else{
                    if (isset($refer[$parentId])) {
                        $parent =& $refer[$parentId];
                        $parent[$child][] =& $list[$key];
                    }
                }
            }

        }

        return $tree;
    }


}
