<?php

namespace App\Http\Controllers\Order;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Member;
use App\Model\MemberStoreinfo;
use App\Model\MemberAddress;
use App\Model\Supply;
use App\Model\GoodCollect;
use App\Model\StoreCollect;
use EasyWeChat\Payment\Order;
use EasyWeChat\Foundation\Application;


class MemberController extends Controller
{
    //
    public $mid;
    public function __construct()
    {
        $this->mid = session('mid');
    }
    public function addressEdit($id)
    {
        $item = MemberAddress::where('id' ,$id)->first();
        return view('home.member.address_edit' ,['item'=>$item]);
    }
    //
    public function addressAdd()
    {
        $data = file_get_contents(app_path('Common/region.json'));
        $data = json_decode($data,true);

        return view('home.member.address_add',['region_data'=>$data]);
    }
    //
    public function addressDel(Request $request)
    {
        $id = $request->input('id');
        $rs = MemberAddress::where('id',$id)->delete();
        if($rs){
            return response()->json(['msg'=>'删除成功!','status'=>'success']);
        }else{
            return response()->json(['msg'=>'删除失败,请重试!','status'=>'error']);
        }
        dd($id);
    }
    //
    public function addressSave(Request $request)
    {

        // dd($request->all());
        $id = $request->input('addr_id');
        $name = $request->input('consignee');
        $phone = $request->input('phone_mob');
        $tel = $request->input('phone_tel');
        $full_address = $request->input('region_name');
        $region_id = $request->input('region_id');
        if($request->has('is_default')){
            $is_default = $request->input('is_default');

        }else{
            $is_default =0;
        }
        $street = $request->input('address');
        //如果设为默认 查询数据库 把其他的isdefault 全变为0
        if($is_default){
            MemberAddress::where('mid',session('mid'))->update(['is_default'=>0]);
        }
        //没有设置默认就添加
        $md =MemberAddress::where('id' ,$id)->first();
        $md->name = $name;
        $md->phone = $phone;
        $md->tel = $tel;
        $md->full_address = $full_address;
        $md->region_id = $region_id;
        $md->is_default = $is_default;
        $md->street = $street;
        $md->mid = session('mid');
        $rs = $md->save();
        if($rs){
            return response()->json(['msg'=>'保存成功!','status'=>'success']);

        }else{
            return response()->json(['msg'=>'保存成功!','status'=>'error']);
        }


    }

    //
    public function addressCreate(Request $request)
    {
        // dd($request->all());
        $name = $request->input('consignee');
        $phone = $request->input('phone_mob');
        $tel = $request->input('phone_tel');
        $full_address = $request->input('region_name');
        $region_id = $request->input('region_id');
        if($request->has('is_default')){
            $is_default = $request->input('is_default');

        }else{
            $is_default =0;
        }
        $street = $request->input('address');

        //如果设为默认 查询数据库 把其他的isdefault 全变为0
        if($is_default){
            MemberAddress::where('mid',session('mid'))->update(['is_default'=>0]);
        }
        //没有设置默认就添加
        $md =new MemberAddress;
        $md->name = $name;
        $md->phone = $phone;
        $md->tel = $tel;
        $md->full_address = $full_address;
        $md->region_id = $region_id;
        $md->is_default = $is_default;
        $md->street = $street;
        $md->mid = session('mid');
        $rs = $md->save();
        if($rs){
            return response('<script>alert("添加成功!");location.href="/member/address"</script>');

        }else{
            return response('error', 400);
        }



    }

    public function setdefault(Request $request){
        $id = $request->input('id');
        MemberAddress::where('mid' , session('mid'))->update(['is_default'=>0]);
        $rs = MemberAddress::where('id' ,$id)->update(['is_default'=>1]);
        if($rs){
            return response()->json(['msg'=>'设置成功','status'=>'success']);
        }else{
            return response()->json(['msg'=>'设置失败!请重试!','status'=>'error']);
        }

    }



    //
    public function address()
    {
        $addr = MemberAddress::where('mid',session('mid'))->get();
        return view('home.member.address' ,['addr'=>$addr]);
    }





    //
    public function collect()
    {
        //收藏的店铺
        $stores = StoreCollect::with('stores')->withCount(['goods'])->where('member_id',session('mid'))->get();
        $saled_total = \DB::table('supplys')->where('member_id',session('mid'))->sum('saled_num');
        // dd($saled_total);
        // dd($stores->toArray());



        // 收藏的商品
        $goods = GoodCollect::with('goods.kinds')->where('member_id',session('mid'))->get();
        // dd($goods->toArray());
        //销量
        // dump($this->mid);
        // dump(session('mid'));
        // dump($goods->toArray());
        // dd($stores->toArray());


        return view('home.member.collect',['stores'=>$stores ,'goods'=>$goods ,'store_saled_total'=>$saled_total]);
    }


    //
    public function idValid()
    {
        return view('home.member.id_valid');
    }


    //
    public function index()
    {
        //logo 名字
        $store = MemberStoreinfo::with('member')->where('member_id' ,session('mid'))->first();
        $member = Member::where('id' ,session('mid'))->first();

        if($store){
            if(empty($store->logo)) $store->logo = session('avatar');
            return view('home.member.index',['store'=>$store,'member'=>$member]);

        }else{
            //没注册店铺的个人页面
            $logo = session('avatar');
            $name = session('nickname');
            return view('home.member.index2',['member'=>$member,'logo'=>$logo,'name'=>$name]);
        }

        // if(!$store || empty($store->logo)) $store->logo = session('avatar');
        //
        // return view('home.member.index',['store'=>$store]);
    }


    //
    public function info()
    {
        return view('home.member.info');
    }


    //
    public function jingyingValid()
    {
        return view('home.member.jingying_valid');
    }


    //
    public function setting()
    {
        return view('home.member.setting');
    }


    //
    public function validIndex()
    {
        return view('home.member.valid_index');
    }


    // 转到wxcontroller里了


    // public function vip()
    // {
    //     $user = session('wechat.oauth_user');
    //     $options=require config_path().'/wechat.php';
    //     $app = new Application($options);
    //     $js = $app->js;
    //
    //     //订单详情
    //     $payment = $app->payment;
    //     // $prepayId = '123213213';
    //     // $config = $payment->configForJSSDKPayment($prepayId);
    //     // dump($js->config(array('onMenuShareQQ', 'onMenuShareWeibo','chooseWXPay'), true));
    //     // dd($config);
    //
    //
    //     $attributes = [
    //         'trade_type'       => 'JSAPI', // JSAPI，NATIVE，APP...
    //         'body'             => '升级金牌会员',
    //         'detail'           => '升级金牌会员880块',
    //         // 'out_trade_no'     => '1217752501201407033233368019',
    //         'out_trade_no'     => date('Ymdhis').strrand(5),
    //         'total_fee'        => 1, // 单位：分
    //         'notify_url'       => 'http://sj.71mh.com/wx/member-notify', // 支付结果通知网址，如果不设置则会使用配置里的默认地址
    //         'openid'           => $user->id, // trade_type=JSAPI，此参数必传，用户在商户appid下的唯一标识，
    //         // ...
    //     ];
    //     $order = new Order($attributes);
    //
    //     $result = $payment->prepare($order);
    //
    //     // dd($result);
    //     if ($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS'){
    //         $prepayId = $result->prepay_id;
    //         $config = $payment->configForJSSDKPayment($prepayId);
    //     }
    //
    //     $out_trade_no = $attributes['out_trade_no'];
    //     \Log::info('myopenid :' .$user->id);
    //     // return view('wx.paybutton',['js'=>$js,'config'=>$config]);
    //
    //
    //
    //     return view('home.member.vip',['out_trade_no'=>$out_trade_no,'js'=>$js,'config'=>$config]);
    //
    //
    //     // return view('home.member.vip');
    // }

    public function xieyi()
    {
        return view('home.member.xieyi');
    }



    public function myGoods()
    {
        // $pagenum = 10;

        //供应列表
        // $supplys = Supply::with('supplyAttrs.attrs','kinds')->where('member_id', session('mid'))->orderBy('id','desc')->paginate($pagenum);
        $mid = session('mid');
        return view('home.member.my-goods' ,['mid'=>$mid]);
    }

    public function wantOrder()
    {
        // $pagenum = 10;

        //供应列表
        // $supplys = Supply::with('supplyAttrs.attrs','kinds')->where('member_id', session('mid'))->orderBy('id','desc')->paginate($pagenum);
        $mid = session('mid');
        return view('home.member.want-order' ,['mid'=>$mid]);
    }





}
