<?php

namespace App\Http\Controllers\Order;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\MemberStoreinfo;

class StoreController extends Controller
{

    //编辑店铺信息
    public function editStore(){
        $data = MemberStoreinfo::where('member_id' , session('id'))->first();

        return view('home.store.edit' , ['store'=>$data]);
    }

    //添加店铺信息
    public function addStoreinfo(){

        // $city = file_get_contents(app_path().'/Common/region_level4.json');

        return view('home.store.add');
    }


    public function checkName(Request $request){
        $store_name = $request->input('store_name');
        $rs = MemberStoreinfo::where('store_name', $store_name)->count();
        if($rs){
            return 'false';
        }else{
            return 'true';
        }
        // $city = file_get_contents(app_path().'/Common/region_level4.json');

        // return view('home.store.add');
    }

    public function create(Request $request){

        dd($request->all());

    }

    //店铺首页
    public function index(){

        return view('home.store.index');
    }
    //实力展示 上传图片 以及描述
    public function showinfo(){

        return view('home.store.showinfo');
    }
}
