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

        $pagenum = 10;
        //店铺基本信息
        $info = MemberStoreinfo::where('member_id' , session('mid'))->first();
        //供应列表
        $supplys = Supply::with('supplyAttrs.attrs','kinds')->where('member_id', session('mid'))->orderBy('id','desc')->paginate($pagenum);
        // dump($supplys->toArray());

        //采购列表
        $wants = Want::with('wantAttrs.attrs','kinds')->withCount('quotes')->where('member_id', session('mid'))->orderBy('id','desc')->paginate(10);
        //关注收藏数目
        $collect_num = StoreCollect::where('store_id', session('mid'))->count();
        //最近浏览数目


        //交易订单数目


        return view('home.store.index' ,['info'=>$info ,'supplys'=>$supplys ,'wants'=>$wants ,'collect_num'=>$collect_num]);
    }
    //店铺首页
    public function view($id){

        $pagenum = 10;
        //店铺基本信息 以member_id  去member-storeinfo表里面找
        $info = MemberStoreinfo::where('member_id' , $id)->first();
        //供应列表
        $supplys = Supply::with('supplyAttrs.attrs','kinds')->where('member_id', $id)->orderBy('id','desc')->paginate($pagenum);
        // dump($supplys->toArray());

        //采购列表
        $wants = Want::with('wantAttrs.attrs','kinds')->withCount('quotes')->where('member_id', $id)->orderBy('id','desc')->paginate($pagenum);
        //关注收藏数目
        $collect_num = StoreCollect::where('store_id', $id)->count();
        //最近浏览数目


        //交易订单数目

        //你是否收藏了该用户
        $is_collect = StoreCollect::where('store_id',$id)->where('member_id',session('mid'))->count();


        return view('home.store.view' ,['info'=>$info ,'supplys'=>$supplys ,'wants'=>$wants ,'collect_num'=>$collect_num,'is_collect'=>$is_collect]);
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
    public function resizeUpload(Request $request)
    {
        $base64_image_content = $request->input('compressValue');
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
