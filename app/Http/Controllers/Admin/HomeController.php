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
        // dd($data->toArray());
        return view('admin.member-list' ,['data'=>$data]);
    }

    public function orderList(Request $request)
    {

        $page = empty($request->input('page'))? 1: $request->input('page');
        $type = empty($request->input('type'))? 1: $request->input('type');
        $kind_id = empty($request->input('kid'))? 0: $request->input('kind_id');
        $region_id = empty($request->input('region_id'))? 0: $request->input('region_id');
        $orderstring =  $request->input('order');
        $keyword = empty($request->input('keyword'))? '':$request->input('keyword') ;
        // $store_member_id = session('mid') ;
        //查询店铺订单
        // $store_member_id = empty($request->input('store_member_id'))? '':$request->input('store_member_id') ;;
        // $member_id = session('mid') ;
        $pagenum = 10; //每页显示数
        $obj = SupplyOrder::with('supply.supplyAttrs.attrs','supply.kinds','storeinfo','orderfight','userinfo');



        // if($store_member_id) $obj= $obj->where('store_member_id' , $store_member_id);
        // if($member_id) $obj= $obj->where('member_id' , $member_id);
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

                    break;
                case 'confirm':
                    # code...待确认
                    $obj->where('status',0);
                    break;
                case 'pending':
                    # code...待付款
                    $obj->where('status',1);
                    break;
                case 'accepted':
                    # code...
                    //已付款 待发货
                    $obj->where('status',2);
                    break;
                case 'shipped':
                    # code...已发货 待收货
                    $obj->where('status',3);
                    break;
                case 'finished':
                    # code...已收货 待评价
                    $obj->where('status',4);
                    break;
                case 'fight':
                    # code... 售后 双方进行交涉 不行 平台介入
                    $obj->whereIn('status',array(10,13,14));
                    break;
                case 'done':
                    # code... 评价完成 订单完成
                    $obj->where('status',5);
                    break;
                case 'cancel':
                    # code..9 订单取消
                    $obj->where('status',9);
                    break;
                case 'moneyback':
                    # code..申请退款
                    $obj->whereIn('status',array(11,12));
                    break;

                default:
                    # code...    yyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyy
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


        return view('admin.order-list' ,  ['data'=>$return]);
        // $return = $obj->paginate($pagenum);

        // return response()->json($return);
    }

    public function tradeList()
    {

        $data = Member::with('memberinfo','defaultaddr','store')->get();
        return view('admin.trade-member-list' ,['data'=>$data]);
    }

    public function tradeOrder(Request $request)
    {
        $type = $request->has('type')?$request->input('type'):die(404);
        $mid = $request->has('mid')?$request->input('mid'):die(404);

        switch ($type) {
            case 'supply':
                $data = \App\Model\Supply::with('supplyAttrs.attrs','kinds','orders','storeinfo')->get()->toArray();
                return view('admin.trade-order-supply',['data'=>$data]);
                break;
            case 'buy':
                # code...
                break;
            case 'good':
                # code...
                break;
            case 'want':
                # code...
                break;
            case 'quote':
                # code...
                break;
            case 'yuyue':
                # code...
                break;

            default:
                # code...
                break;


        }



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
