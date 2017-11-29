<?php

namespace App\Http\Controllers\Order;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SupplyOrderController extends Controller
{
    //
    //我的供货列表
    public function index(Request $request)
    {
        $type = $request->input('type')? $request->input('type'):'';
        if(empty($type)) $type = 'all_orders';
        //供应列表
        // $supplys = Supply::with('supplyAttrs.attrs','kinds')->where('member_id', session('mid'))->orderBy('id','desc')->paginate($pagenum);
        // $mid = session('mid');
        return view('home.supply.supply-order' ,['type'=>$type]);
    }

    //下单添加订单
    //库存减相对数量 售量加相对数量



    //点击收货 改变状态 
}
