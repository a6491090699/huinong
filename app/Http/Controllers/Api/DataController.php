<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Kind;
use App\Model\Guige;
use App\Model\MemberAddress;
use App\Model\GoodCollect;
use App\Model\Quote;
use App\Model\Want;

class DataController extends Controller
{
    //
    protected $mid;

    public function __construct(){
        //开发开启
        $this->mid = session('mid')? session('mid'): 1;

        //线上开启
        // if(!empty(session('mid'))) $this->mid = session('mid');


    }

    public function getKinds()
    {

        $data = Kind::listToTree();
        if($data){
            return json_encode(array(
                'code'=>0,
                'data'=>$data
            ));
        }

    }


    public function getGuige()
    {

        $data = Guige::all();
        dd($data);

    }

    public function getCity()
    {
        // dd('/hehe');
        $data = require app_path('Common/city.json');
        // return response();
    }

    public function getAddress()
    {
        $mid = $this->mid;
        $data = MemberAddress::getAddress($mid);
        return $data;
    }

    //收藏商品
    public function collect_good(Request $request)
    {
        $gid = $request->input('gid');
        $add = array(
            'member_id'=> $this->mid,
            'good_id'=> $gid
        );
        $rs = GoodCollect::create($add);
        $return = array();
        if($rs){
            $return['msg']= '收藏成功!';
            $return['done']= true;

        }else{
            $return['msg']= '收藏失败,请重试!';
            $return['done']= false;
        }
        return json_encode($return);



    }
    //收藏店铺
    public function collect_store(Request $request)
    {
        $store_id = $request->input('store_id');
        $add = array(
            'member_id'=> $this->mid,
            'store_id'=> $store_id
        );
        $rs = StoreCollect::create($add);
        $return = array();
        if($rs){
            $return['msg']= '收藏成功!';
            $return['done']= true;

        }else{
            $return['msg']= '收藏失败,请重试!';
            $return['done']= false;
        }
        return json_encode($return);



    }

    //收藏的商品列表

    public function collect_goods(Request $request)
    {
        $gid = $request->input('gid');
        $data = GoodCollect::getMemberCollect($gid);
        $data = $data->toArray();

        return $data;



    }

    //异步获取用户采购列表接口
    public function getMemberWantList(Request $request)
    {
        $page = empty($request->input('page'))? $request->input('page') : 1;
        $keyword = empty($request->input('keyword'))? $request->input('keyword') : '';

        if($keyword)
        {
            $return = Kind::where('title', 'like', '%'.$keyword.'%')->paginate(10);
        }else{
            $return = Kind::paginate(10);
        }
        dump($return->toJson());
        dd($return->toArray());

    }

    //获取采购列表
    public function getWantList(Request $request)
    {
        $page = empty($request->input('page'))? 1: $request->input('page');
        $keyword = empty($request->input('keyword'))? '':$request->input('keyword') ;
        $pagenum = 10; //每页显示数
        if($keyword)
        {
            $return = Want::where('title', 'like', '%'.$keyword.'%')->with('wantAttrs.attrs','quotes','kinds')->paginate($pagenum);
        }else{
            $return = Want::with('wantAttrs.attrs','quotes','kinds')->paginate($pagenum);
        }
        // $return = $return->toArray();
        // $ret = array();
        // $ret['status'] = '1';
        // $ret['data'] = $return;
        return $return->toJson();
        // dump($return->toJson());
        // dd($return->toArray());

    }

    //获取我的报价列表
    public function getQuote(Request $request)
    {
        $page = empty($request->input('page'))? 1: $request->input('page') ;
        $status = empty($request->input('type'))? '': $request->input('type') ;
        // $keyword = empty($request->input('keyword'))? '':$request->input('keyword') ;
        $pagenum = 10; //每页显示数
        if($status == 0){
            $return = Quote::with('wants.wantAttrs.attrs','wants.kinds')->where('member_id',$this->mid)->paginate($pagenum);

        }else{
            $return = Quote::with('wants.wantAttrs.attrs','wants.kinds')->where('member_id',$this->mid)->where('status',$status)->paginate($pagenum);

        }

        // $return = $return->toArray();
        // $ret = array();
        // $ret['status'] = '1';
        // $ret['data'] = $return;
        return $return->toJson();
        // dump($return->toJson());
        // dd($return->toArray());

    }


    //获取采购列表
    public function getSupplyAll(Request $request)
    {
        $page = empty($request->input('page'))? 1: $request->input('page');
        $orderstring = empty($request->input('order'))? 1: $request->input('order');
        $orderstring = explode(' ',$orderstring);
        $order = $orderstring[0];
        $orderway = $orderstring[1];
        $keyword = empty($request->input('keyword'))? '':$request->input('keyword') ;
        $pagenum = 10; //每页显示数
        if($keyword)
        {
            $return = Want::with('wantAttrs.attrs','quotes','kinds')->where('title', 'like', '%'.$keyword.'%')->orderBy($order ,$orderway)->paginate($pagenum);
        }else{
            $return = Want::with('wantAttrs.attrs','quotes','kinds')->orderBy($order ,$orderway)->paginate($pagenum);
        }
        // $return = $return->toArray();
        // $ret = array();
        // $ret['status'] = '1';
        // $ret['data'] = $return;
        return $return->toJson();
        // dump($return->toJson());
        // dd($return->toArray());

    }

}
