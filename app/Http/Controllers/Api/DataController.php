<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Kind;
use App\Model\Guige;
use App\Model\MemberAddress;
use App\Model\GoodCollect;
use App\Model\Want;

class DataController extends Controller
{
    //
    protected $mid;

    public function __construct(){

        if(!empty(session('mid'))) $this->mid = session('mid');


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
        return $data;
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
        $page = empty($request->input('page'))? $request->input('page') : 1;
        $keyword = empty($request->input('keyword'))? $request->input('keyword') : '';

        if($keyword)
        {
            $return = Want::where('title', 'like', '%'.$keyword.'%')->with('wantAttrs.attrs','quotes','kinds')->paginate(10);
        }else{
            $return = Want::with('wantAttrs.attrs','quotes','kinds')->paginate(10);
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
