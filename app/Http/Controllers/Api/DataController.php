<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Kind;

class DataController extends Controller
{
    //
    public function getKinds()
    {
        // $data1 = Kind::getJsonList();
        // $data = file_get_contents('http://m.huamu.com/index.php?app=mlselection&act=gcategory4app&top_cate_id=1');
        $data1 = Kind::all();
        $data1 = $data1->toArray();
        function list_to_tree($list, $pk='id', $pid = 'pid', $child = 'child', $root = 0) {
            // 创建Tree
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
        $data1 = list_to_tree($data1);
        // $narr= array();
        // foreach($data1 as $key=> $val){
        //     $narr[$val['pid']][] = array('id'=>$val['id'] , 'name'=>$val['name']);
        // }
        //
        // $data =json_decode($data,true);
        //
        // dump($narr);
        dump($data1);
        // dd(123213);

    }
}
