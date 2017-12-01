<?php

namespace App\Http\Controllers\order;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\SupplyOrder;
use EasyWeChat\Payment\Order;
use EasyWeChat\Foundation\Application;

class BuyOrderController extends Controller
{
    //
    public function index(Request $request)
    {
        $type = $request->input('type')? $request->input('type'):'';
        if(empty($type)) $type = 'all_orders';

        return view('home.supply.buy-order' ,['type'=>$type]);
    }

    public function pay($id)
    {
        $orderinfo = SupplyOrder::with('supply')->where('id',$id)->first();
        // dd($orderinfo);


        //支付sdk 信息包
        $user = session('wechat.oauth_user');
        $options=require config_path().'/wechat.php';
        $app = new Application($options);
        $js = $app->js;

        //订单详情
        $payment = $app->payment;


        $attributes = [
            'trade_type'       => 'JSAPI', // JSAPI，NATIVE，APP...
            'body'             => $orderinfo->supply->goods_name.'['.$orderinfo->supplys_id.']',
            'detail'           => $orderinfo->supply->goods_name.'[id:'.$orderinfo->supplys_id.',数目:'.$orderinfo->number.',总价格:'.$orderinfo->total_price.']',
            'out_trade_no'     => $orderinfo->order_sn,
            // 'total_fee'        => $orderinfo->total_price*100, // 单位：分
            'total_fee'        => 1, // 单位：分
            'notify_url'       => 'http://sj.71mh.com/api/wx/buy-notify', // 支付结果通知网址，如果不设置则会使用配置里的默认地址
            'openid'           => $user->id, // trade_type=JSAPI，此参数必传，用户在商户appid下的唯一标识，
            // ...
        ];
        $order = new Order($attributes);

        $result = $payment->prepare($order);

        // dd($result);
        if ($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS'){
            $prepayId = $result->prepay_id;
            $config = $payment->configForJSSDKPayment($prepayId);
        }

        $out_trade_no = $attributes['out_trade_no'];

        // return view('wx.paybutton',['js'=>$js,'config'=>$config]);



        return view('wx.pay-page',['orderinfo'=>$orderinfo,'out_trade_no'=>$out_trade_no,'js'=>$js,'config'=>$config]);
    }

    public function received(Request $request)
    {
        if(!$request->has('id')) return response()->json(['status'=>'error','msg'=>'参数发生错误!']);
        $id = $request->input('id');
        $obj =SupplyOrder::where('id',$id)->first();

        $obj->status = 4;
        if($obj->save()) return response()->json(['status'=>'success','msg'=>'确认收货操作成功!']);
        return response()->json(['status'=>'fail','msg'=>'确认收货操作失败!']);
    }

    public function comment($id)
    {

    }

    public function del(Request $request)
    {
        if(!$request->has('id')) return response()->json(['status'=>'error','msg'=>'参数发生错误!']);
        $id = $request->input('id');
        $obj =SupplyOrder::where('id',$id)->first();

        if($obj->delete()) return response()->json(['status'=>'success','msg'=>'订单删除成功!']);
        return response()->json(['status'=>'fail','msg'=>'订单删除失败!']);
    }


}