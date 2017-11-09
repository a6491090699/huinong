<?php

namespace App\Http\Controllers\Order;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\MemberStoreinfo;
use App\Model\Supply;
use App\Model\Want;
use App\Model\StoreCollect;

class StoreController extends Controller
{
    //店铺首页
    public function index(){
        //店铺基本信息
        $info = MemberStoreinfo::where('member_id' , session('mid'))->first();
        //供应列表
        $supplys = Supply::with('supplyAttrs.attrs','kinds')->where('member_id', session('mid'))->get();
        // dump($supplys->toArray());

        //采购列表
        $wants = Want::with('wantAttrs.attrs','kinds')->withCount('quotes')->where('member_id', session('mid'))->get();
        //关注收藏数目
        $collect_num = StoreCollect::where('store_id', session('mid'))->count();
        //最近浏览数目


        //交易订单数目


        return view('home.store.index' ,['info'=>$info ,'supplys'=>$supplys ,'wants'=>$wants ,'collect_num'=>$collect_num]);
    }

    //编辑店铺信息
    public function editStore(){
        $data = MemberStoreinfo::where('member_id' , session('id'))->first();

        return view('home.store.edit' , ['store'=>$data]);
    }

    //添加店铺信息
    public function addStoreinfo(){

        // $city = file_get_contents(app_path().'/Common/region_level4.json');

        return view('home.store.add');
    }


    public function checkName(Request $request){
        $store_name = $request->input('store_name');
        $rs = MemberStoreinfo::where('store_name', $store_name)->count();
        if($rs){
            return 'false';
        }else{
            return 'true';
        }
        // $city = file_get_contents(app_path().'/Common/region_level4.json');

        // return view('home.store.add');
    }

    public function uploadfile(Request $request)
    {
        //要让文件能被访问到 php artisan storage:link 然后 huinong.app/storage/hehe.png
        $filepath = session('mid');

        $path = $request->file('logo')->store('public/logo/'.$filepath);
        // /public/2017/10/18/J9bL2J8TQmuvLhRdYVhZxDcfYivv9cNEojANs1zY.png
        // return str_replace('public','storage', $path);
        return $path;

    }


    public function create(Request $request){

        // dd($request->all());
        $store_name = $request->input('store_name');
        $store_sale = $request->input('biz_scope');
        $base_address = $request->input('region_name');
        $region_id = $request->input('region_id');
        $street = $request->input('address');
        $phone = $request->input('pc_mobile');
        $tel = $request->input('pc_tel');
        $qq = $request->input('cs_qq');
        $description = $request->input('description');
        //处理logo 图片
        $logo = $this->uploadfile($request);

        $obj =new MemberStoreinfo;
        $obj->store_name = $store_name;
        $obj->store_sale = $store_sale;
        $obj->base_address = $base_address;
        $obj->region_id = $region_id;
        $obj->street = $street;
        $obj->phone = $phone;
        $obj->tel = $tel;
        $obj->qq = $qq;
        $obj->logo = $logo;
        $obj->addtime = time();
        $obj->member_id = session('mid');
        $rs = $obj->save();
        if($rs) return response('<script>alert("设置成功");location.href="/store/index"</script>');
        return response('<script>alert("设置失败");location.href="/store/index"</script>');


    }


    //实力展示 上传图片 以及描述
    public function showinfo(){

        return view('home.store.showinfo');
    }
}
