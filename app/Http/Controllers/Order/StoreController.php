<?php

namespace App\Http\Controllers\Order;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\MemberStoreinfo;
use App\Model\Member;
use App\Model\Supply;
use App\Model\SupplyOrder;
use App\Model\Want;
use App\Model\StoreCollect;

class StoreController extends Controller
{
    //店铺首页
    public function index(){

        $pagenum = 10;
        //店铺基本信息
        $info = MemberStoreinfo::where('member_id' , session('mid'))->first();
        //供应列表
        $supplys = Supply::with('supplyAttrs.attrs','kinds')->where('member_id', session('mid'))->orderBy('id','desc')->paginate($pagenum);
        // dump($supplys->toArray());

        //采购列表
        $wants = Want::with('wantAttrs.attrs','kinds','address')->withCount('quotes')->where('member_id', session('mid'))->orderBy('id','desc')->paginate(10);
        //关注收藏数目
        $collect_num = StoreCollect::where('store_id', session('mid'))->count();
        //最近浏览数目


        //交易订单数目 求购订单+供应订单
        //供应订单
        $supplyOrder = Member::withCount('supplyOrder')->where('id',session('mid'))->first();
        $supply_count = $supplyOrder->supply_order_count;
        //求购订单
        $want_count = 0;

        $order_count = $supply_count+$want_count;


        return view('home.store.index' ,['info'=>$info ,'supplys'=>$supplys ,'wants'=>$wants ,'collect_num'=>$collect_num,'order_count'=>$order_count]);
    }
    //店铺首页
    public function view($id){

        $pagenum = 10;
        //店铺基本信息 以member_id  去member-storeinfo表里面找
        $info = MemberStoreinfo::where('member_id' , $id)->first();
        \DB::table('member-storeinfo')->increment('view_count');
        //供应列表
        $supplys = Supply::with('supplyAttrs.attrs','kinds')->where('member_id', $id)->orderBy('id','desc')->paginate($pagenum);
        // dump($supplys->toArray());

        //采购列表
        $wants = Want::with('wantAttrs.attrs','kinds')->withCount('quotes')->where('member_id', $id)->orderBy('id','desc')->paginate($pagenum);
        //关注收藏数目
        $collect_num = StoreCollect::where('store_id', $id)->count();


        //交易订单数目 求购订单+供应订单
        //供应订单
        $supplyOrder = Member::withCount('supplyOrder')->where('id',$id)->first();
        $supply_count = $supplyOrder->supply_order_count;
        //求购订单
        $want_count = 0;

        $order_count = $supply_count+$want_count;


        //你是否收藏了该用户
        $is_collect = StoreCollect::where('store_id',$id)->where('member_id',session('mid'))->count();


        return view('home.store.view' ,['info'=>$info ,'supplys'=>$supplys ,'wants'=>$wants ,'collect_num'=>$collect_num,'is_collect'=>$is_collect,'order_count'=>$order_count]);
    }

    //编辑店铺信息
    public function editStore(){
        $data = MemberStoreinfo::where('member_id' , session('mid'))->first();
        // dd($data);
        return view('home.store.edit' , ['store'=>$data]);
    }

    //保存编辑店铺信息
    public function saveStore(Request $request){
        // dd($request);
        $data = MemberStoreinfo::where('member_id' , session('mid'))->first();

        $store_name = $request->input('store_name');
        $store_sale = $request->input('biz_scope');
        $base_address = $request->input('region_name');
        $region_id = $request->input('region_id');
        $street = $request->input('address');
        $phone = $request->input('pc_mobile');
        $tel = $request->input('pc_tel');
        $qq = $request->input('cs_qq');
        $description = $request->input('description');



        $data->store_name = $store_name;
        $data->store_sale = $store_sale;
        $data->base_address = $base_address;
        $data->region_id = $region_id;
        $data->street = $street;
        $data->phone = $phone;
        $data->tel = $tel;
        $data->qq = $qq;
        $rs = $data->save();

        if($rs) return response()->json(['status'=>0 , 'info'=>'更新成功!']);
        return response()->json(['status'=>0 , 'info'=>'更新失败!请重试!']);


    }

    //添加店铺信息
    public function addStoreinfo(){

        // $city = file_get_contents(app_path().'/Common/region_level4.json');

        return view('home.store.add');
    }


    public function checkName(Request $request){
        $store_name = $request->input('store_name');
        $rs = MemberStoreinfo::where('store_name' , $store_name);
        if($request->has('store_id')){
            $rs->where('id','<>',$request->input('store_id'));
        }
        $res = $rs->count();
        if($res){
            return 'false';
        }else{
            return 'true';
        }

        // $store_name = $request->input('store_name');
        // $rs = MemberStoreinfo::where('store_name', $store_name)->count();
        // if($rs){
        //     return 'false';
        // }else{
        //     return 'true';
        // }

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
    public function resizeUpload(Request $request)
    {
        if(!$request->has('compressValue')) return config('common.logo_default');
        $base64_image_content = $request->input('compressValue');
        if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_image_content, $result)){
            $type = $result[2];

            $new_file = storage_path().'/app/public/logo/'.session('mid').'/';

            //如果文件不存在,则创建
            if(!file_exists($new_file))
            {
                mkdir($new_file, 0777, true);
            }

            $new_file = $new_file.time(). '.' .$type;
            if (file_put_contents($new_file, base64_decode(str_replace($result[1],'', $base64_image_content)))){
                $return = str_replace(storage_path().'/app/' ,'',$new_file);
                return $return;
                // return 'public/'.
            }else{
                return false;
            }
        }
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

        // $logo = $this->uploadfile($request);
        if(!$logo=$this->resizeUpload($request)) return response()->view('home.common.404',['msg'=>'上传图片发生错误!']);


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
        $obj->desc = $description;
        $obj->addtime = time();
        $obj->member_id = session('mid');
        $rs = $obj->save();
        if($rs) return response('<script>alert("添加成功");location.href="/store/index"</script>');
        return response('<script>alert("添加失败");location.href="/store/index"</script>');


    }


    //实力展示 上传图片 以及描述
    public function showinfo(){
        $store = MemberStoreinfo::where('member_id' ,session('mid'))->first(['imgs']);
        return view('home.store.showinfo',['imgs'=>$store->imgs]);
    }
    public function multiUpload(Request $request)
    {
        $base64_image_content = $request->input('img');
        if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_image_content, $result)){
            $type = $result[2];
            // $root =
            // dump(public_path());
            // dump($_SERVER['DOCUMENT_ROOT']);
            // dd($_SERVER);
            $new_file = storage_path().'/app/public/logo/'.session('mid').'/';

            //如果文件不存在,则创建
            if(!file_exists($new_file))
            {
                mkdir($new_file, 0777, true);
            }

            $new_file = $new_file.time().strrand(5). '.' .$type;
            if (file_put_contents($new_file, base64_decode(str_replace($result[1],'', $base64_image_content)))){
                $return = str_replace(storage_path().'/app/' ,'',$new_file);
                return $return;
                // return 'public/'.
            }else{
                return false;
            }
        }
    }

    public function uploadImgs(Request $request)
    {
        $file = $this->multiUpload($request);
        $store = MemberStoreinfo::where('member_id' ,session('mid'))->first();
        $store->imgs .= $file.';';
        if($store->save()){

            return response()->json(['img'=>getPic($file)]);
            // echo 'success';
        }else{
            // return false;
            echo 'fail';
        }

    }

    public function resetImgs()
    {
        $store = MemberStoreinfo::where('member_id' ,session('mid'))->first();
        $store->imgs = '';
        $rs = $store->save();
        if($rs) return response()->json(['status'=>1]);

    }
}
