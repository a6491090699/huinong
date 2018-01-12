<?php

namespace App\Http\Controllers\order;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\SupplyOrder;
use App\Model\Supply;
use App\Model\MoneyBack;
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
        \DB::beginTransaction();
        $obj =SupplyOrder::where('id',$id)->first();
        $supplys_id = $obj->supplys_id;
        $buy_num = $obj->number;
        $obj->status = 4;
        if($obj->save()){

            //库存减少 销量上升
            $good = Supply::where('id',$supplys_id)->first();
            $good->number -= $buy_num;
            $good->saled_num += $buy_num;
            if($good->save()){
                \DB::commit();
                return response()->json(['status'=>'success','msg'=>'确认收货操作成功!']);
            }else{
                \DB::rollback();
                return response()->json(['status'=>'success','msg'=>'确认收货操作成功!']);
            }
        }
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

    public function fight(Request $request)
    {
        if(!$request->has('id')) return response()->json(['status'=>'error','msg'=>'参数发生错误!']);
        $id = $request->input('id');
        \DB::beginTransaction();
        $obj =SupplyOrder::where('id',$id)->first();
        $supplys_id = $obj->supplys_id;
        $buy_num = $obj->number;
        $obj->status = 10;
        if($obj->save()){

            //库存减少 销量上升
            $good = Supply::where('id',$supplys_id)->first();
            $good->number -= $buy_num;
            $good->saled_num += $buy_num;
            if($good->save()){
                \DB::commit();
                return response()->json(['status'=>'success','msg'=>'请双方协商,若达不到协调,可申请平台介入!']);
            }else{
                \DB::rollback();
                return response()->json(['status'=>'success','msg'=>'发生错误 错误代码119!']);
            }
        }
        return response()->json(['status'=>'fail','msg'=>'发生错误 错误代码120!']);
    }
    public function moneyback(Request $request)
    {
        if(!$request->has('id')) return response()->json(['status'=>'error','msg'=>'参数发生错误!']);
        $id = $request->input('id');
        $order = SupplyOrder::where('id',$id)->first();
        //生成退款表单记录
        //把订单的状态变为退款中 10

        \DB::beginTransaction();
        if(MoneyBack::where('supply_orders_id',$id)->count()) return response()->json(['status'=>'error','msg'=>'已经提交退款申请!']);
        $n = new MoneyBack;
        $n->supply_orders_id = $id;
        $n->pay_price = $order->total_price;
        $n->status =0;
        $n->addtime = time();
        $n->pay_out_trade_no = date('Ymdhis').strrand(5);
        if($n->save()){
            $order->status= 11;
            if($order->save()){
                \DB::commit();
                return response()->json(['status'=>'success','msg'=>'成功提交申请!']);
            }else{
                \DB::rollback();
                return response()->json(['status'=>'error','msg'=>'发生错误, 错误代码123!']);
            }

        }else{
            return response()->json(['status'=>'error','msg'=>'发生错误, 错误代码124!']);
        }


    }
    public function editPrice(Request $request)
    {
        if(!$request->has('id')) return response()->json(['status'=>'error','msg'=>'参数发生错误!']);
        $id = $request->input('id');
        $price = $request->input('price');
        $obj =SupplyOrder::where('id',$id)->first();

        //买家修改完成
        $obj->edit_price_status = 2;
        //修改订单价格
        $obj->total_price = $price;

        if($obj->save()){
            // 推送消息给卖家

             return response()->json(['status'=>'success','msg'=>'修改成功!']);
        }
        return response()->json(['status'=>'fail','msg'=>'发生错误 错误代码122!']);
    }

    public function orderMoneybackIntervene(Request $request)
    {
        return response()->json(['status'=>'error','msg'=>'功能待开发!']);

    }


}
