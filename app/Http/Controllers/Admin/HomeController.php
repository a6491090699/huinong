<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Member;
use App\Model\SupplyOrder;

class HomeController extends Controller
{
    //
    public function index()
    {
        return view('admin.index');
    }


    public function memberList()
    {
        $data = Member::with('memberinfo','defaultaddr','store')->get();

        $pageconfig = array(
            'breadcrumb_title'=>'会员管理',
            'breadcrumb_index'=>'/admin/member',
            'locate'=>'用户'
        );
        return view('admin.member-list' ,['data'=>$data , 'pageconfig'=>$pageconfig]);
    }

    public function orderList(Request $request)
    {

        $page = empty($request->input('page'))? 1: $request->input('page');
        $type = empty($request->input('type'))? 1: $request->input('type');
        $kind_id = empty($request->input('kid'))? 0: $request->input('kind_id');
        $region_id = empty($request->input('region_id'))? 0: $request->input('region_id');
        $orderstring =  $request->input('order');
        $keyword = empty($request->input('keyword'))? '':$request->input('keyword') ;
        //查询店铺订单
        $pagenum = 10; //每页显示数
        $obj = SupplyOrder::with('supply.supplyAttrs.attrs','supply.kinds','storeinfo','orderfight','userinfo');

        if($keyword) $obj= $obj->where('goods_name' ,'like','%'.$keyword.'%');

        if($orderstring){
            $orderstring = explode(' ',$orderstring);
            $order = $orderstring[0];
            $orderway = $orderstring[1];
            $obj= $obj->orderBy($order ,$orderway);
        }else{
            $obj= $obj->orderBy('id' ,'desc');
        }

        if($type){
            switch ($type) {
                case 'all_orders':
                    # code...

                    $locate = '全部订单';
                    break;
                case 'confirm':
                    # code...待确认
                    $obj->where('status',0);
                    $locate = '待确认';
                    break;
                case 'pending':
                    # code...待付款
                    $obj->where('status',1);
                    $locate = '待付款';
                    break;
                case 'accepted':
                    # code...
                    //已付款 待发货
                    $obj->where('status',2);
                    $locate = '待发货';
                    break;
                case 'shipped':
                    # code...已发货 待收货
                    $obj->where('status',3);
                    $locate = '待收货';
                    break;
                case 'finished':
                    # code...已收货 待评价
                    $obj->where('status',4);
                    $locate = '待评价';
                    break;
                case 'fight':
                    # code... 售后 双方进行交涉 不行 平台介入
                    $obj->whereIn('status',array(10,13,14));
                    $locate = '售后中';
                    break;
                case 'done':
                    # code... 评价完成 订单完成
                    $obj->where('status',5);
                    $locate = '已完成';
                    break;
                case 'cancel':
                    # code..9 订单取消
                    $obj->where('status',9);
                    $locate = '已取消';

                    break;
                case 'moneyback':
                    # code..申请退款
                    $obj->whereIn('status',array(11,12));
                    $locate = '退款中';
                    break;

                default:
                    $locate = '';

                    break;
            }

        }

        if($region_id){

            $obj= $obj->where('region_id' ,$region_id);
        }
        if($kind_id){
            $obj= $obj->where('kid' ,$kind_id);
        }


        $return = $obj->get();
        $return = $return->toArray();


        $pageconfig = array(
            'breadcrumb_title'=>'订单管理',
            'breadcrumb_index'=>'/admin/order',
            'locate'=>$locate
        );



        return view('admin.order-list' ,  ['data'=>$return ,'pageconfig'=>$pageconfig]);
        // $return = $obj->paginate($pagenum);

        // return response()->json($return);
    }

    public function tradeList()
    {

        $data = Member::with('memberinfo','defaultaddr','store')->get();
        $pageconfig = array(
            'breadcrumb_title'=>'ta的订单',
            'breadcrumb_index'=>'/admin/trade',
            'locate'=>'会员列表',
        );
        return view('admin.trade-member-list' ,['data'=>$data ,'pageconfig'=>$pageconfig]);
    }

    public function tradeOrder(Request $request)
    {
        $type = $request->has('type')?$request->input('type'):die(404);
        $mid = $request->has('mid')?$request->input('mid'):die(404);
        $pageconfig = array(
            'breadcrumb_title'=>'ta的订单',
            'breadcrumb_index'=>'/admin/trade',
        );

        switch ($type) {
            case 'supply':
                $locate= '供货订单';
                $pageconfig['locate']= $locate;
                // $data = \App\Model\SupplyOrder::with('supply.supplyAttrs.attrs','supply.kinds','storeinfo','orderfight','userinfo')->where('store_member_id',$mid)->get();
                $data = \App\Model\SupplyOrder::with('supply')->where('store_member_id',$mid)->get();
                // dump($data->toArray());
                return view('admin.trade-order-supply',['data'=>$data , 'pageconfig'=>$pageconfig]);
                break;
            case 'buy':
                # code...
                $locate= '采购订单';
                $pageconfig['locate']= $locate;
                // $data = \App\Model\SupplyOrder::with('supply.supplyAttrs.attrs','supply.kinds','storeinfo','orderfight')->where('member_id',$mid)->get();
                $data = \App\Model\SupplyOrder::where('member_id',$mid)->get();
                // dump($data->toArray());
                return view('admin.trade-order-buy',['data'=>$data , 'pageconfig'=>$pageconfig]);
                break;
            case 'good':
                # code...
                $data = \App\Model\Supply::where('member_id',$mid)->get();
                // $data = \App\Model\Supply::with('supplyAttrs.attrs','kinds','orders','storeinfo')->get();
                $locate= 'ta的商品';
                $pageconfig['locate']= $locate;
                // dump($data->toArray());
                return view('admin.member-goods',['data'=>$data , 'pageconfig'=>$pageconfig]);

                break;
            case 'want':
                # code...
                $locate= 'ta的求购';
                $pageconfig['locate']= $locate;
                // $data = \App\Model\Want::with('wantAttrs.attrs','quotes','kinds','address')->where('member_id',$mid)->get();
                $data = \App\Model\Want::where('member_id',$mid)->get();
                $pageconfig['locate']= $locate;
                // dump($data->toArray());
                return view('admin.want-list',['data'=>$data , 'pageconfig'=>$pageconfig]);

                break;
            case 'quote':
                # code...
                $locate= 'ta的报价';
                $pageconfig['locate']= $locate;
                // $data = \App\Model\Quote::where('member_id',$mid)->get();
                $data = \App\Model\Quote::with('wants.wantAttrs.attrs','wants.kinds')->where('member_id',$mid)->get();
                // dump($data->toArray());
                return view('admin.quote-list',['data'=>$data , 'pageconfig'=>$pageconfig]);
                break;
            case 'yuyue':
                # code...
                $locate= 'ta的预约看货';
                $pageconfig['locate']= $locate;
                $data = \App\Model\Yuyue::with('supply.supplyAttrs.attrs','supply.storeinfo')->where('member_id',$mid)->get();
                // dump($data->toArray());
                return view('admin.yuyue-list',['data'=>$data , 'pageconfig'=>$pageconfig]);

                break;

            default:
                # code...
                $locate= '';
                $pageconfig['locate']= $locate;
                break;


        }


        $pageconfig = array(
            'breadcrumb_title'=>'ta的订单',
            'breadcrumb_index'=>'/admin/trade',
            'locate'=>$locate,

        );
        return view('admin.trade-order-supply',['data'=>$data ,'pageconfig'=>$pageconfig]);




    }





    // public function tradeOrderSupply(Request $request)
    // {
    //
    // }
    //
    // public function tradeOrderBuy(Request $request)
    // {
    //
    // }
    //
    // public function tradeOrderGood(Request $request)
    //
    //
    // }
    //
    // public function tradeOrderWant(Request $request)
    // {
    //
    // }
    //
    // public function tradeOrderQuote(Request $request)
    // {
    //
    // }
    //
    // public function tradeOrderYuyue(Request $request)
    // {
    //
    // }






}
