<?php

namespace App\Http\Controllers\Order;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Want;

class WantController extends Controller
{
    //求购大厅列表
    public function index(){

        return view('home.index');
    }

    //发布求购
    public function fabu(Request $request){
        // $this->validate();
        // exit;
        if($request->isMethod('post'))
        {
            //表单提交
            $obj = new Want;
            $data = array(
                '123'
            );
        }


        return view('home.want.fabu');
    }

    //我的求购
    public function myWant(){
        return view('home.index');
    }




}
