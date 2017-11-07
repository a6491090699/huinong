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

        $city = file_get_contents(app_path().'/Common/city.json');

        return view('home.store.add',['city_json'=>$city]);
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
