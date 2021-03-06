<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use EasyWeChat\Payment\Order;
use EasyWeChat\Foundation\Application;
use App\Model\Want;
use App\Model\Supply;
use App\Model\SupplyOrder;
use App\Model\Member;
use App\Model\MemberStoreinfo;


class WxController extends Controller
{
    //
    // public function index()
    // {
    //     $user = session('wechat.oauth_user'); // 拿到授权用户资料
    //     // dd($user->id);
    //     return view('wx.index');
    // }

    // 下单跳到购物车界面
    public function cart($id)
    {

        // $user = session('wechat.oauth_user'); // 拿到授权用户资料


        $data = Supply::with('supplyAttrs.attrs','kinds','storeinfo')->withCount('yuyue')->where('id' ,$id)->first();
        // dd($data);

        return view('home.cart',['item'=>$data]);
    }
    // 生成订单
    public function buy(Request $request)
    {
        // dd($request->all());
        // $user = session('wechat.oauth_user'); // 拿到授权用户资料
        $supplys_id = $request->input('id');
        $price_one = $request->input('price');
        $buy_num = $request->input('buy_num');
        $good = Supply::where('id',$supplys_id)->first(['number']);
        $stock = $good->number;
        if($stock<$buy_num){
            return back()->withErrors(['stock'=>"库存不足,库存只剩下{$stock},请重新选择数量!"]);
        }



        // $order = new SupplyOrder;
        //
        // $order->supplys_id =$supplys_id;
        // $order->member_id = session('mid');
        // $order->status = 0;
        // $order->addtime = time();
        // $order->number = $buy_num;
        // $order->total_price = 12

        //地址
        // $data = \App\Model\MemberAddress::where('mid' , session('mid'))->get(['full_address','region_id','street','phone','name','id'])->toArray();
        $address_data = \App\Model\MemberAddress::where('mid' , session('mid'))->get()->toArray();
        $default_addr = \App\Model\MemberAddress::where('mid' , session('mid'))->where('is_default',1)->first();
        // if(!$default_addr) ;
        // dd($data);
        if(empty($address_data)) return response("<script>alert('请先添加你的收货人信息!');location.href='/member/address';</script>");
        $address = array();
        foreach($address_data as $val){
            $newarr = array();
            $newarr['id']=$val['id'];
            // $newarr['name']=$val['full_address']."\t".$val['street'];
            $newarr['name']=$val['name']."\t".$val['full_address'];
            // $newarr['member_address_id']=$val['id'];
            $address[] = $newarr;
        }
        $address_json = json_encode($address);



        // dd($address_data);
        $data = Supply::with('supplyAttrs.attrs','storeinfo')->where('id' ,$supplys_id)->first();
        // dd($data);


        return view('home.order-confirm',['item'=>$data,'buy_num'=>$buy_num ,'address_json'=>$address_json,'addr'=>$address_data ,'default_addr'=>$default_addr] );
    }

    //创建订单
    public function supplyOrderCreate(Request $request)
    {
        // dd($request->all());

        $address_id = $request->input('address_id');
        $price_one = $request->input('price_one');
        $buy_num = $request->input('buy_num');
        $postscript = $request->input('postscript');//留言
        $supplys_id = $request->input('supplys_id');//留言
        $store_member_id = $request->input('store_member_id');//留言

        //地址信息 address
        $addr = \App\Model\MemberAddress::where('id' , $address_id)->first();




        // 把信息写入订单表
        $obj = new SupplyOrder;
        $obj->supplys_id = $supplys_id;
        $obj->member_id = session('mid');
        $obj->status = 0;
        $obj->addtime = time();
        $obj->number = $buy_num;
        $obj->total_price = round($buy_num*$price_one,2);
        // $obj->ship_price = 0;
        // $obj->ship_type = 1;
        $obj->tip = $postscript;
        $obj->reciever = $addr->name;
        $obj->reciever_phone =  $addr->phone;
        $obj->reciever_address =  $addr->full_address;
        $obj->order_sn =  date('Ymdhis').strrand(5);
        $obj->bzj_order_sn =  date('Ymdhis').strrand(5);
        $obj->store_member_id =  $store_member_id;

        if($obj->save()) return response()->json(['status'=>'success','msg'=>'提交订单成功!联系商家确定订单,然后付款!']);
        return response()->json(['status'=>'error']);



    }


    public function notify()
    {

        // \Log::info('heheh|||yyyyyyyyyy');
        $options=require config_path().'/wechat.php';
        $app = new Application($options);
        $response = $app->payment->handleNotify(function($notify, $successful){
            // 使用通知里的 "微信支付订单号" 或者 "商户订单号" 去自己的数据库找到订单
            $order = Want::where('wx_out_trade_no',$notify->out_trade_no)->first();
            // $order = 查询订单($notify->out_trade_no);
            if (!$order) { // 如果订单不存在
                return 'Order not exist.'; // 告诉微信，我已经处理完了，订单没找到，别再通知我了
            }
            // 如果订单存在
            // 检查订单是否已经更新过支付状态
            if ($order->is_pay == 1) { // 假设订单字段“支付时间”不为空代表已经支付
                return true; // 已经支付成功了就不再更新了
            }
            // 用户是否支付成功
            if ($successful) {
                // 不是已经支付状态则修改为已经支付状态
                // $order->paid_at = time(); // 更新支付时间为当前时间
                $order->is_pay = 1;
                $order->save();

            } else { // 用户支付失败
                $order->is_pay = 0;
                // $order->delete();

            }
            $order->save(); // 保存订单
            return true; // 返回处理完成
        });
        return $response;

    }



    public function vip()
    {
        $user = session('wechat.oauth_user');
        // dd($user);
        $options=require config_path().'/wechat.php';
        $app = new Application($options);
        $js = $app->js;

        //订单详情
        $payment = $app->payment;
        // $prepayId = '123213213';
        // $config = $payment->configForJSSDKPayment($prepayId);
        // dump($js->config(array('onMenuShareQQ', 'onMenuShareWeibo','chooseWXPay'), true));
        // dd($config);


        $attributes = [
            'trade_type'       => 'JSAPI', // JSAPI，NATIVE，APP...
            'body'             => '升级金牌会员',
            'detail'           => '升级金牌会员880块',
            // 'out_trade_no'     => '1217752501201407033233368019',
            'out_trade_no'     => date('Ymdhis').strrand(5),
            'total_fee'        => config('common.open_vip_price'), // 单位：分
            'notify_url'       => 'http://sj.71mh.com/api/wx/member-notify', // 支付结果通知网址，如果不设置则会使用配置里的默认地址
            'openid'           => $user->id, // trade_type=JSAPI，此参数必传，用户在商户appid下的唯一标识，
            // ...
        ];
        // dump($attributes);
        // dd($user->id);
        $order = new Order($attributes);

        $result = $payment->prepare($order);

        // dd($result);
        if ($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS'){
            $prepayId = $result->prepay_id;
            $config = $payment->configForJSSDKPayment($prepayId);
        }

        $out_trade_no = $attributes['out_trade_no'];

        // return view('wx.paybutton',['js'=>$js,'config'=>$config]);



        return view('home.member.vip',['out_trade_no'=>$out_trade_no,'js'=>$js,'config'=>$config]);


        // return view('home.member.vip');
    }

    public function memberNotify()
    {
        // file_put_contents(public_path.'/123.txt','213213213213213');
        \Log::info('123213213');

        $options=require config_path().'/wechat.php';
        $app = new Application($options);
        $response = $app->payment->handleNotify(function($notify, $successful){
            \Log::info('receive-openid:'.$notify->openid);
            \Log::info('receive-successful:'.$successful);
            \Log::info('receive-package:'.$notify);
            // 使用通知里的 "微信支付订单号" 或者 "商户订单号" 去自己的数据库找到订单
            $member = Member::where('openid',$notify->openid)->first();
            // $order = 查询订单($notify->out_trade_no);
            if (!$member) { // 如果订单不存在
                return 'member not exist.'; // 告诉微信，我已经处理完了，订单没找到，别再通知我了
            }
            // 如果订单存在
            // 检查订单是否已经更新过支付状态
            if ($member->rank == 1) { // 假设订单字段“支付时间”不为空代表已经支付
                return true; // 已经支付成功了就不再更新了
            }
            // 用户是否支付成功
            if ($successful) {
                // 不是已经支付状态则修改为已经支付状态
                // $order->paid_at = time(); // 更新支付时间为当前时间
                $member->rank = 1;
                $member->vip_addtime = time();
                $member->vip_endtime = strtotime('+1 year');
                // $member->save();

            } else { // 用户支付失败
                $member->rank = 0;
                // $order->delete();

            }
            $member->save(); // 保存订单
            \Log::info('Memberinfo='.$member);
            return true; // 返回处理完成
        });
        return $response;
    }

    //订单加急处理回调
    public function supplyNotify()
    {
        $options=require config_path().'/wechat.php';
        $app = new Application($options);
        $response = $app->payment->handleNotify(function($notify, $successful){
            // 使用通知里的 "微信支付订单号" 或者 "商户订单号" 去自己的数据库找到订单
            $order = Supply::where('wx_out_trade_no',$notify->out_trade_no)->first();
            // $order = 查询订单($notify->out_trade_no);
            if (!$order) { // 如果订单不存在
                return 'Order not exist.'; // 告诉微信，我已经处理完了，订单没找到，别再通知我了
            }
            // 如果订单存在
            // 检查订单是否已经更新过支付状态
            if ($order->is_emergency == 1) { // 假设订单字段“支付时间”不为空代表已经支付
                return true; // 已经支付成功了就不再更新了
            }
            // 用户是否支付成功
            if ($successful) {
                // 不是已经支付状态则修改为已经支付状态
                // $order->paid_at = time(); // 更新支付时间为当前时间
                $order->is_emergency = 1;
                $order->save();

            } else { // 用户支付失败
                $order->is_pay = 0;
                // $order->delete();

            }
            $order->save(); // 保存订单
            return true; // 返回处理完成
        });
        return $response;
    }

    //购买订单支付回调
    public function buyNotify()
    {
        $options=require config_path().'/wechat.php';
        $app = new Application($options);
        $response = $app->payment->handleNotify(function($notify, $successful){
            // 使用通知里的 "微信支付订单号" 或者 "商户订单号" 去自己的数据库找到订单
            $order = SupplyOrder::where('order_sn',$notify->out_trade_no)->first();
            // $order = 查询订单($notify->out_trade_no);
            if (!$order) { // 如果订单不存在
                return 'Order not exist.'; // 告诉微信，我已经处理完了，订单没找到，别再通知我了
            }
            // 如果订单存在
            // 检查订单是否已经更新过支付状态
            if ($order->is_pay ==1 && $order->status>1) { // 假设订单字段“支付时间”不为空代表已经支付
                return true; // 已经支付成功了就不再更新了
            }
            // 用户是否支付成功
            if ($successful) {
                // 不是已经支付状态则修改为已经支付状态
                // $order->paid_at = time(); // 更新支付时间为当前时间
                $order->is_pay = 1;
                $order->status = 2;
                $order->save();

            }
            // $order->save(); // 保存订单
            return true; // 返回处理完成
        });
        return $response;
    }

    public function jsapi()
    {
        $user = session('wechat.oauth_user');
        $options=require config_path().'/wechat.php';
        $app = new Application($options);
        $js = $app->js;

        //订单详情
        $payment = $app->payment;
        // $prepayId = '123213213';
        // $config = $payment->configForJSSDKPayment($prepayId);
        // dump($js->config(array('onMenuShareQQ', 'onMenuShareWeibo','chooseWXPay'), true));
        // dd($config);


        $attributes = [
            'trade_type'       => 'JSAPI', // JSAPI，NATIVE，APP...
            'body'             => 'iPad mini 16G 白色',
            'detail'           => 'iPad mini 16G 白色',
            // 'out_trade_no'     => '1217752501201407033233368019',
            'out_trade_no'     => date('Ymdhis').strrand(5),
            'total_fee'        => 1, // 单位：分
            'notify_url'       => 'http://sj.71mh.com/api/wx/wantnotify', // 支付结果通知网址，如果不设置则会使用配置里的默认地址
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



        return view('wx.paybutton',['js'=>$js,'config'=>$config]);
        // return view('wx.paybutton',['js'=>$js]);

        // dd($js);
        // $openid = $user->id;

        // $user = session('wechat.oauth_user');
        // $openid = $user->id;
        // $appid = config('wechat.app_id');
        // $appsecret = config('wechat.secret');
        // $payment = config('wechat.payment');
        // $mch_id = $payment['merchant_id'];
        // $key = $payment['key'];
        // $business = new Business(
        //     $appid,
        //     $appsecret,
        //     $mch_id,
        //     $key
        // );
        //
        // $order = new Order();
        // $order->body = 'test body';
        // $order->out_trade_no = md5(uniqid().microtime());
        // $order->total_fee = '1'; // 单位为 “分”, 字符串类型
        // $order->openid = $openid;
        // $order->notify_url = 'http://sj.71mh.com/wx/notify';


        // return view('wx.jsapi');
    }

    //求购发布页面
    public function wantFabu(){
        //调用我的地址里面的联系人

        $data = \App\Model\MemberAddress::where('mid' , session('mid'))->get(['full_address','region_id','street','phone','name','id'])->toArray();
        // dd($data);
        if(empty($data)) return response("<script>alert('请先添加你的收货人信息!');location.href='/member/address';</script>");
        $address = array();
        foreach($data as $val){
            $newarr = array();
            $newarr['id']=$val['id'];
            // $newarr['name']=$val['full_address']."\t".$val['street'];
            $newarr['name']=$val['name']."\t".$val['full_address'];
            // $newarr['member_address_id']=$val['id'];
            $address[] = $newarr;
        }
        $address_json = json_encode($address);




        //支付sdk 信息包
        $user = session('wechat.oauth_user');
        $options=require config_path().'/wechat.php';
        $app = new Application($options);
        $js = $app->js;

        //订单详情
        $payment = $app->payment;


        $attributes = [
            'trade_type'       => 'JSAPI', // JSAPI，NATIVE，APP...
            'body'             => '求购信息佣金',
            'detail'           => '求购信息佣金十块钱',
            // 'out_trade_no'     => '1217752501201407033233368019',
            'out_trade_no'     => date('Ymdhis').strrand(5),
            'total_fee'        => config('common.fabu_want_price'), // 单位：分
            'notify_url'       => 'http://sj.71mh.com/api/wx/notify', // 支付结果通知网址，如果不设置则会使用配置里的默认地址
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



        return view('home.want.fabu',['address_json'=>$address_json,'out_trade_no'=>$out_trade_no,'js'=>$js,'config'=>$config]);
    }

    //商品发布页面
    public function supplyFabu()
    {
        // dump(session('mid'));
        $base_address = MemberStoreinfo::where('member_id' ,session('mid'))->select('base_address','region_id')->get()->toJson();
        // dd($base_address->region_id);
        //支付sdk 信息包
        $user = session('wechat.oauth_user');
        $options=require config_path().'/wechat.php';
        $app = new Application($options);
        $js = $app->js;

        //订单详情
        $payment = $app->payment;

        $attributes = [
            'trade_type'       => 'JSAPI', // JSAPI，NATIVE，APP...
            'body'             => '发布商品信息佣金',
            'detail'           => '发布商品信息佣金十块钱',
            // 'out_trade_no'     => '1217752501201407033233368019',
            'out_trade_no'     => date('Ymdhis').strrand(5),
            'total_fee'        => config('common.fabu_supply_price'), // 单位：分
            'notify_url'       => 'http://sj.71mh.com/api/wx/supply-notify', // 支付结果通知网址，如果不设置则会使用配置里的默认地址
            'openid'           => $user->id, // trade_type=JSAPI，此参数必传，用户在商户appid下的唯一标识，
            // ...
        ];
        $order = new Order($attributes);

        $result = $payment->prepare($order);

        if ($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS'){
            $prepayId = $result->prepay_id;
            $config = $payment->configForJSSDKPayment($prepayId);
        }

        $out_trade_no = $attributes['out_trade_no'];

        //判断是否会员

        $rank = session('rank')?session('rank'):0;



        return view('home.supply.add',['base_address'=>$base_address,'out_trade_no'=>$out_trade_no,'js'=>$js,'config'=>$config,'rank'=>$rank]);
    }


    // 下单支付页面
    public function buyGoodPage(Request $request){
        if(!$request->has('id')) return response()->view('home.common.404',['msg'=>'传参发生错误!']);
        $id= $request->input('id');
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
    // 保证金
    public function payBzj(Request $request)
    {
        if(!$request->has('id')) return response()->view('home.common.404',['msg'=>'传参发生错误!']);
        $id= $request->input('id');
        $orderinfo = SupplyOrder::with('supply')->where('id',$id)->first();
        //支付sdk 信息包
        $user = session('wechat.oauth_user');
        $options=require config_path().'/wechat.php';
        $app = new Application($options);
        $js = $app->js;

        //订单详情
        $payment = $app->payment;


        $attributes = [
            'trade_type'       => 'JSAPI', // JSAPI，NATIVE，APP...
            'body'             => '卖家缴纳保证金!',
            'detail'           => '卖家缴纳保证金!',
            // 'out_trade_no'     => date('Ymdhis').strrand(5),
            'out_trade_no'     => $orderinfo->bzj_order_sn,
            // 'total_fee'        => $orderinfo->total_price*100, // 单位：分
            'total_fee'        => config('common.bzj_price'), // 单位：分
            'notify_url'       => 'http://sj.71mh.com/api/wx/pay-bzj-notify', // 支付结果通知网址，如果不设置则会使用配置里的默认地址
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


        return view('wx.bzj',['orderinfo'=>$orderinfo,'js'=>$js,'config'=>$config]);
    }

    // public function payBzjNotify()
    // {
    //     \Log::info('yytest');
    //     $options=require config_path().'/wechat.php';
    //     $app = new Application($options);
    //     $response = $app->payment->handleNotify(function($notify, $successful){
    //         \Log::info($notify);
    //         // 使用通知里的 "微信支付订单号" 或者 "商户订单号" 去自己的数据库找到订单
    //         // $order = SupplyOrder::where('bzj_order_sn',$notify->out_trade_no)->first();
    //         // // $order = 查询订单($notify->out_trade_no);
    //         // if (!$order) { // 如果订单不存在
    //         //     return 'Order not exist.'; // 告诉微信，我已经处理完了，订单没找到，别再通知我了
    //         // }
    //         // // 如果订单存在
    //         // // 检查订单是否已经更新过支付状态
    //         // if ($order->pay_bzj ==1) { // 假设订单字段“支付时间”不为空代表已经支付
    //         //     return true; // 已经支付成功了就不再更新了
    //         // }
    //         // // 用户是否支付成功
    //         // if ($successful) {
    //         //     // 不是已经支付状态则修改为已经支付状态
    //         //     // $order->paid_at = time(); // 更新支付时间为当前时间
    //         //     $order->pay_bzj = 1;
    //         //     $order->save();
    //         //
    //         // }
    //         // // $order->save(); // 保存订单
    //         return true; // 返回处理完成
    //     });
    //     return $response;
    // }

    public function payBzjNotify()
    {
        \Log::info('yytest');
        $options=require config_path().'/wechat.php';
        $app = new Application($options);
        $response = $app->payment->handleNotify(function($notify, $successful){
            // 使用通知里的 "微信支付订单号" 或者 "商户订单号" 去自己的数据库找到订单
            $order = SupplyOrder::where('bzj_order_sn',$notify->out_trade_no)->first();
            // $order = 查询订单($notify->out_trade_no);
            if (!$order) { // 如果订单不存在
                return 'Order not exist.'; // 告诉微信，我已经处理完了，订单没找到，别再通知我了
            }
            // 如果订单存在
            // 检查订单是否已经更新过支付状态
            if ($order->pay_bzj ==1) { // 假设订单字段“支付时间”不为空代表已经支付
                return true; // 已经支付成功了就不再更新了
            }
            // 用户是否支付成功
            if ($successful) {
                // 不是已经支付状态则修改为已经支付状态
                // $order->paid_at = time(); // 更新支付时间为当前时间
                $order->pay_bzj = 1;
                $order->save();

            }
            // $order->save(); // 保存订单
            return true; // 返回处理完成
        });
        return $response;
    }




}
