<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Kind;
use App\Model\Attribute;
use App\Model\MemberAddress;
use App\Model\GoodCollect;
use App\Model\Quote;
use App\Model\Want;
use App\Model\MemberStoreinfo;
use App\Model\Supply;

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


    public function getAttribute(Request $request)
    {
        $full_kind_id = $request->input('cate_full_id');
        $arr =explode(',', $full_kind_id);
        $pid = $arr[0];
        // $kid = $request->input('kid');

        // $data = $obj->getParentGuige($kid);
        $data = Attribute::where('kinds_id' , $pid)->get();
        return response()->json(['data'=>$data ,'code'=>0]);
        // dd($data);
    }

    public function getCity()
    {
        // dd('/hehe');
        $data = require app_path('Common/city.json');
        // return response();
    }
    public function getSubCity(Request $request)
    {
        $pid = $request->input('pid');
        $city = file_get_contents(app_path().'/Common/city.json');
        $city = json_decode($city , true);
        dump($city);
        foreach($city['data'] as $val){
            if($val['id'] == $pid) $sub = $val['child'];
        }
        return response()->json(['data'=>$sub ,'code'=>0,'select_pls'=>'请选择...']);

        dd($sub);
        // return $city;
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
        $kind_id = empty($request->input('page'))? 1: $request->input('kind_id');
        $region_id = empty($request->input('page'))? 1: $request->input('region_id');
        $orderstring =  $request->input('order');
        // $order = 'id';
        // $orderway = 'desc';

        // if($orderstring != null){
        //     $orderstring = explode(' ',$orderstring);
        //     $order = $orderstring[0];
        //     $orderway = $orderstring[1];
        // }

        $keyword = empty($request->input('keyword'))? '':$request->input('keyword') ;
        $pagenum = 10; //每页显示数
        $obj = Supply::with('supplyAttrs.attrs','kinds','orders');


        if($keyword) $obj= $obj->where('goods_name' ,'like','%'.$keyword.'%');

        if($orderstring){
            $orderstring = explode(' ',$orderstring);
            $order = $orderstring[0];
            $orderway = $orderstring[1];
            $obj= $obj->orderBy($order ,$orderway);
        }else{
            $obj= $obj->orderBy('id' ,'desc');
        }

        if($region_id){

            $obj= $obj->where('region_id' ,$region_id);
        }
        if($kind_id){
            $obj= $obj->where('kid' ,$kid);
        }

        $obj->withCount(['orders'=>function($query){
            $query->where('status',3);//完成的状态量
        }]);

        $return = $obj->paginate($pagenum);



        // if($keyword)
        // {
        //     $return = Supply::with('supplyAttrs.attrs','kinds','orders')->where('goods_name', 'like', '%'.$keyword.'%')->orderBy($order ,$orderway)->paginate($pagenum);
        // }else{
        //     $return = Supply::with('supplyAttrs.attrs','kinds')->withCount(['orders'=>function($query){
        //         $query->where('status',3);//完成的状态量
        //     }])->orderBy($order ,$orderway)->paginate($pagenum);
        // }
        // $return = $return->toArray();
        // $ret = array();
        // $ret['status'] = '1';
        // $ret['data'] = $return;
        return $return->toJson();
        // dump($return->toJson());
        // dd($return->toArray());

    }

    public function getBase()
    {
        //获取用户基地
        // $mid = $this->mid;
        // return MemberStoreinfo::where('member_id' ,$mid)->field('base_address')->first()->toArray();



    }

}
