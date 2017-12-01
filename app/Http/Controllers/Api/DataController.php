<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Kind;
use App\Model\Attribute;
use App\Model\MemberAddress;
use App\Model\GoodCollect;
use App\Model\StoreCollect;
use App\Model\Quote;
use App\Model\Want;
use App\Model\MemberStoreinfo;
use App\Model\Supply;
use App\Model\SupplyOrder;
use App\Model\Yuyue;

class DataController extends Controller
{
    //
    protected $mid;

    public function __construct(){
        //开发开启
        $this->mid = session('mid');




    }

    public function getKinds()
    {

        $data = Kind::listToTree();
        // dd($data);
        if($data){
            return json_encode(array(
                'code'=>0,
                'data'=>$data
            ));
        }

    }


    public function getAttribute(Request $request)
    {
        //逐级查找 设定到父类就可以了
        $full_kind_id = $request->input('cate_full_id');
        $arr =explode(',', $full_kind_id);

        for($i=count($arr)-1 ; $i>=0;$i--){
            // echo 1;
            // $item = array_pop($arr);
            $idata = Attribute::where('kinds_id' , $arr[$i])->get()->toArray();
            if(!empty($idata)) return response()->json(['data'=>$idata ,'code'=>0]);

        }
        // $pid = $arr[0];
        // dd($arr);
        // $kid = $request->input('kid');

        // $data = $obj->getParentGuige($kid);
        // $data = Attribute::where('kinds_id' , $pid)->get();
        // return response()->json(['data'=>$data ,'code'=>0]);
        // dd($data);
    }

    public function getKindUnit($kid)
    {
        $rs = Kind::where('id',$kid)->first(['unit'])->toArray();

        return response()->json(['code'=>0 , 'unit'=>$rs['unit']]);
    }

    public function getCity()
    {
        // dd('/hehe');
        $data = file_get_contents(app_path('Common/city.json'));
        return $data;
        // return response();
    }

    public function getSubCity(Request $request)
    {
        $pid = $request->input('pid');
        $reid = $request->input('reid');

        $city = file_get_contents(app_path().'/Common/region_level4.json');
        $city = json_decode($city , true);
        $subarr = get_sub_value($city , $pid );
        if(isset($subarr['child'])){
            $sub =$subarr['child'];
            return response()->json(['data'=>$sub ,'code'=>0,'select_pls'=>'请选择...']);
        }

        // foreach($city['data'] as $val){
        //     if($val['id'] == $pid) $sub = $val['child'];
        // }



        // return $city;
        // return response();
    }

    // public function getSubRegion(Request $request)
    // {
    //     $pid = $request->input('pid');
    //     $city = file_get_contents(app_path().'/Common/region.json');
    //     $city = json_decode($city , true);
    //     // dump($city);
    //     dd($val)
    //     foreach($city as $val){
    //         if($val['code'] == $pid) $sub = $val['sub'];
    //     }
    //     if(!isset($sub)){
    //         foreach($city)
    //     }
    //     return response()->json(['data'=>$sub ,'code'=>0,'select_pls'=>'请选择...']);
    //
    //     // dd($sub);
    //     // return $city;
    //     // return response();
    // }

    public function getAddress()
    {
        $mid = session('mid');
        $data = MemberAddress::getAddress($mid);
        return $data;
    }

    //收藏商品
    public function collectGood(Request $request)
    {
        $good_id = $request->input('item_id');
        $obj =new GoodCollect;
        $obj->member_id = session('mid');
        $obj->good_id = $good_id;
        $rs = $obj->save();
        if($rs) return response()->json(['msg'=>'收藏成功!' ,'done'=>1]);
    }
    //取消收藏商品
    public function cancelCollectGood(Request $request)
    {
        $good_id = $request->input('item_id');
        $rs =GoodCollect::where('member_id',session('mid'))->where('good_id',$good_id)->delete();

        if($rs) return response()->json(['msg'=>'取消收藏!' ,'done'=>1]);

    }
    //收藏店铺
    public function collectStore(Request $request)
    {
        $store_id = $request->input('item_id');
        $obj =new StoreCollect;
        $obj->member_id = session('mid');
        $obj->store_id = $store_id;
        $rs = $obj->save();
        if($rs) return response()->json(['msg'=>'收藏成功!' ,'done'=>1]);


    }
    //取消收藏店铺
    public function cancelCollectStore(Request $request)
    {
        $store_id = $request->input('item_id');
        $rs =StoreCollect::where('member_id',session('mid'))->where('store_id',$store_id)->delete();

        if($rs) return response()->json(['msg'=>'取消收藏!' ,'done'=>1]);


    }

    // //收藏店铺
    // public function collect_store(Request $request)
    // {
    //     $store_id = $request->input('store_id');
    //     $add = array(
    //         'member_id'=> $this->mid,
    //         'store_id'=> $store_id
    //     );
    //     $rs = StoreCollect::create($add);
    //     $return = array();
    //     if($rs){
    //         $return['msg']= '收藏成功!';
    //         $return['done']= true;
    //
    //     }else{
    //         $return['msg']= '收藏失败,请重试!';
    //         $return['done']= false;
    //     }
    //     return json_encode($return);
    //
    //
    //
    // }
    //
    // //收藏的商品列表
    //
    // public function collect_goods(Request $request)
    // {
    //     $gid = $request->input('gid');
    //     $data = GoodCollect::getMemberCollect($gid);
    //     $data = $data->toArray();
    //
    //     return $data;
    //
    //
    //
    // }

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
        $kind_id = empty($request->input('page'))? 1: $request->input('kind_id');
        $region_id = empty($request->input('page'))? 1: $request->input('region_id');
        $orderstring =  $request->input('order');
        $keyword = empty($request->input('keyword'))? '':$request->input('keyword') ;
        $mid = empty($request->input('mid'))? '':$request->input('mid') ;
        $pagenum = 10; //每页显示数
        $obj = Want::with('wantAttrs.attrs','quotes','kinds','address');

        if($keyword) $obj= $obj->where('title' ,'like','%'.$keyword.'%');

        if($orderstring){
            $orderstring = explode(' ',$orderstring);
            $order = $orderstring[0];
            $orderway = $orderstring[1];
            $obj= $obj->orderBy($order ,$orderway);
        }else{
            $obj= $obj->orderBy('id' ,'desc');
        }

        // if($region_id){
        //     $obj= $obj->where('region_id' ,$region_id);
        // }
        if($kind_id){
            $obj= $obj->where('kid' ,$kid);
        }
        if($mid){
            $obj= $obj->where('member_id' ,$mid);
        }

        $obj->withCount('quotes');

        //是否过期
        // $obj->where('cutday','>=',time());
        $obj->where('is_pay',1);
        $return = $obj->paginate($pagenum);



        return response()->json($return);


    }

    //获取我的报价列表
    public function getQuote(Request $request)
    {
        $page = empty($request->input('page'))? 1: $request->input('page') ;
        $status = empty($request->input('type'))? '': $request->input('type') ;
        // $keyword = empty($request->input('keyword'))? '':$request->input('keyword') ;
        $pagenum = 10; //每页显示数
        if($status == 0){
            $return = Quote::with('wants.wantAttrs.attrs','wants.kinds')->where('member_id',session('mid'))->paginate($pagenum);

        }else{
            $return = Quote::with('wants.wantAttrs.attrs','wants.kinds')->where('member_id',session('mid'))->where('status',$status)->paginate($pagenum);

        }

        // $return = $return->toArray();
        // $ret = array();
        // $ret['status'] = '1';
        // $ret['data'] = $return;
        return $return->toJson();
        // dump($return->toJson());
        // dd($return->toArray());

    }


    //获取供应列表
    public function getSupplyAll(Request $request)
    {
        // dump($request->all());
        $page = empty($request->input('page'))? 1: $request->input('page');
        $kid = empty($request->input('kind_id'))? 0: $request->input('kind_id');
        $region_id = empty($request->input('region_id'))? 0: $request->input('region_id');
        // $region_id = empty($request->input('region_id'))? 1: $request->input('region_id');
        $orderstring =  $request->input('order');
        $keyword = empty($request->input('keyword'))? '':$request->input('keyword') ;
        $mid = empty($request->input('mid'))? '':$request->input('mid') ;
        $pagenum = 10; //每页显示数
        $obj = Supply::with('supplyAttrs.attrs','kinds','orders','storeinfo');


        if($mid) $obj= $obj->where('member_id' , $mid);
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
            $data = file_get_contents(app_path().'/Common/region_level4.json');
            $data = json_decode($data ,true);
            // dd($region_id);
            $in = getSonList($data['data'] , $region_id);
            // dump(getSonList($data['data'] , 1190));
            // dump($region_id);
            $in = getSon($in);
            $obj= $obj->whereIn('base_region_id' ,explode(',',$in));
        }
        if($kid){

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
        // return $return->toJson();
        return response()->json($return);
        // dump($return->toJson());
        // dd($return->toArray());

    }



    public function getBase()
    {
        //获取用户基地
        // $mid = $this->mid;
        // return MemberStoreinfo::where('member_id' ,$mid)->field('base_address')->first()->toArray();



    }
    //获取用户供货被购买的订单
    public function getSupplyOrder(Request $request)
    {
        // dd(session('mid'));
        $page = empty($request->input('page'))? 1: $request->input('page');
        $type = empty($request->input('type'))? 1: $request->input('type');
        $kind_id = empty($request->input('page'))? 1: $request->input('kind_id');
        $region_id = empty($request->input('page'))? 1: $request->input('region_id');
        $orderstring =  $request->input('order');
        $keyword = empty($request->input('keyword'))? '':$request->input('keyword') ;
        $store_member_id = session('mid') ;
        $pagenum = 10; //每页显示数
        $obj = SupplyOrder::with('supply.supplyAttrs.attrs','supply.kinds','storeinfo');


        if($store_member_id) $obj= $obj->where('store_member_id' , $store_member_id);
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

                default:
                    # code...    yyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyy
                    break;
            }

        }

        if($region_id){

            $obj= $obj->where('region_id' ,$region_id);
        }
        if($kind_id){
            $obj= $obj->where('kid' ,$kid);
        }


        $return = $obj->paginate($pagenum);

        return response()->json($return);
    }

    //获取用户购买的订单
    public function getBuyOrder(Request $request)
    {
        $page = empty($request->input('page'))? 1: $request->input('page');
        $type = empty($request->input('type'))? 1: $request->input('type');
        $kind_id = empty($request->input('page'))? 1: $request->input('kind_id');
        $region_id = empty($request->input('page'))? 1: $request->input('region_id');
        $orderstring =  $request->input('order');
        $keyword = empty($request->input('keyword'))? '':$request->input('keyword') ;
        $mid = session('mid') ;
        $pagenum = 10; //每页显示数
        $obj = SupplyOrder::with('supply.supplyAttrs.attrs','supply.kinds','storeinfo');


        if($mid) $obj= $obj->where('member_id' , $mid);
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

                default:
                    # code...    yyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyy
                    break;
            }

        }

        if($region_id){

            $obj= $obj->where('region_id' ,$region_id);
        }
        if($kind_id){
            $obj= $obj->where('kid' ,$kid);
        }


        $return = $obj->paginate($pagenum);

        return response()->json($return);
    }

    //获取我的预约列表
    public function getYuyue(Request $request)
    {

        $page = empty($request->input('page'))? 1: $request->input('page');

        $type = empty($request->input('type'))? 1: $request->input('type');

        $orderstring =  $request->input('order');
        $keyword = empty($request->input('keyword'))? '':$request->input('keyword') ;
        $mid = session('mid') ;
        $pagenum = 10; //每页显示数
        $obj = Yuyue::with('supply.supplyAttrs.attrs','storeinfo');

        if($type){
            switch ($type) {
                case 'all':
                    # code...

                    break;
                case 'wait-comfirm':
                    # code...待付款
                    $obj->where('status',0);
                    break;
                case 'wait-look':
                    # code...
                    //已付款 待发货
                    $obj->where('status',1);
                    break;
                case 'wait-comment':
                    # code...已发货 待收货
                    $obj->where('status',2);
                    break;
                case 'finish':
                    # code...已收货 待评价
                    $obj->where('status',3);
                    break;

                default:
                    # code...    yyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyy
                    break;
            }

        }

        if($mid) $obj= $obj->where('member_id' , $mid);

        if($keyword) $obj= $obj->where('goods_name' ,'like','%'.$keyword.'%');

        if($orderstring){
            $orderstring = explode(' ',$orderstring);
            $order = $orderstring[0];
            $orderway = $orderstring[1];
            $obj= $obj->orderBy($order ,$orderway);
        }else{
            $obj= $obj->orderBy('id' ,'desc');
        }


        // $obj->withCount(['orders'=>function($query){
        //     $query->where('status',3);//完成的状态量
        // }]);

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
        // return $return->toJson();
        return response()->json($return);
        // dump($return->toJson());
        // dd($return->toArray());

    }
    //get-my-want
    // public function getMyWant(Request $request)
    // {
    //     dd($request->all());
    //     $page = empty($request->input('page'))? 1: $request->input('page');
    //
    //     $type = empty($request->input('type'))? 1: $request->input('type');
    //
    //     $orderstring =  $request->input('order');
    //     $keyword = empty($request->input('keyword'))? '':$request->input('keyword') ;
    //     $mid = session('mid') ;
    //     $pagenum = 10; //每页显示数
    //     $obj = Want::with('wantAttrs.attrs');
    //
    //     if($mid) $obj= $obj->where('member_id' , $mid);
    //
    //     if($keyword) $obj= $obj->where('goods_name' ,'like','%'.$keyword.'%');
    //
    //     if($orderstring){
    //         $orderstring = explode(' ',$orderstring);
    //         $order = $orderstring[0];
    //         $orderway = $orderstring[1];
    //         $obj= $obj->orderBy($order ,$orderway);
    //     }else{
    //         $obj= $obj->orderBy('id' ,'desc');
    //     }
    //
    //
    //     // $obj->withCount(['orders'=>function($query){
    //     //     $query->where('status',3);//完成的状态量
    //     // }]);
    //
    //     $return = $obj->paginate($pagenum);
    //
    //     return response()->json($return);
    //
    //
    // }



}
