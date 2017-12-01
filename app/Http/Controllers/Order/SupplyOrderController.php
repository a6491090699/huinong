<?php

namespace App\Http\Controllers\Order;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\SupplyOrder;

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



    //商家销售订单 操作

    //点击取消订单
    public function cancel(Request $request)
    {
        // dd($request->all());
        if(!$request->has('id')) return response()->json(['status'=>'error','msg'=>'参数发生错误!']);
        $id = $request->input('id');
        $obj =SupplyOrder::where('id',$id)->first();

        $obj->status = 9;
        if($obj->save()) return response()->json(['status'=>'success','msg'=>'取消订单成功!']);
        return response()->json(['status'=>'fail','msg'=>'取消订单失败!']);



    }
    //点击确定接单 改变状态

    public function confirm(Request $request)
    {
        if(!$request->has('id')) return response()->json(['status'=>'error','msg'=>'参数发生错误!']);
        $id = $request->input('id');
        $obj =SupplyOrder::where('id',$id)->first();

        $obj->status = 1;
        if($obj->save()) return response()->json(['status'=>'success','msg'=>'确认订单成功!']);
        return response()->json(['status'=>'fail','msg'=>'确认订单失败!']);
    }

    //点击发货
    public function sended(Request $request)
    {
        if(!$request->has('id')) return response()->json(['status'=>'error','msg'=>'参数发生错误!']);
        $id = $request->input('id');
        $obj =SupplyOrder::where('id',$id)->first();

        $obj->status = 3;
        if($obj->save()) return response()->json(['status'=>'success','msg'=>'订单发货成功!']);
        return response()->json(['status'=>'fail','msg'=>'订单发货失败!']);
    }
    //删除订单
    public function del(Request $request)
    {
        if(!$request->has('id')) return response()->json(['status'=>'error','msg'=>'参数发生错误!']);
        $id = $request->input('id');
        $obj =SupplyOrder::where('id',$id)->first();

        if($obj->delete()) return response()->json(['status'=>'success','msg'=>'订单删除成功!']);
        return response()->json(['status'=>'fail','msg'=>'订单删除失败!']);
    }
    //点击查看评价


}
