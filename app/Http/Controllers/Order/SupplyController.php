<?php

namespace App\Http\Controllers\Order;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Supply;
use App\Model\SupplyAttr;
use App\Model\MemberStoreinfo;
use App\Model\GoodCollect;

class SupplyController extends Controller
{
    //
    public function index()
    {

        return view('home.supply.index');
    }

    public function addSupply()
    {

        $base_address = MemberStoreinfo::where('member_id' ,1)->select('base_address')->get()->toJson();
        // dd($base_address);
        // dd($base_address);exit;
        return view('home.supply.add',['base_address'=>$base_address]);
    }

    public function editSupply()
    {
        return view('home.supply.edit');
    }

    public function viewSupply($id)
    {
        $data = Supply::with('supplyAttrs.attrs','kinds','storeinfo')->withCount('yuyue')->where('id' ,$id)->first();

        $is_collect = GoodCollect::where('good_id',$id)->where('member_id',session('mid'))->count();

        // dd($data->toArray());
        return view('home.supply.view' ,['item'=>$data ,'is_collect'=>$is_collect]);
    }
    public function create(Request $request)
    {

        switch($request->input('expire_options')){
            case '一天':
                # code...
                $cutday = strtotime('+1 day');
                break;
            case '三天':
                # code...
                $cutday = strtotime('+3 day');
                break;
            case '一周':
                # code...
                $cutday = strtotime('+7 day');
                break;
            case '一个月':
                # code...
                $cutday = strtotime('+1 mouth');
                break;
            case '三个月':
                # code...
                $cutday = strtotime('+3 mouth');
                break;
            case '半年':
                # code...
                $cutday = strtotime('+6 mouth');
                break;
            case '一年':
                # code...
                $cutday = strtotime('+1 year');
                break;

            default:

                $cutday = '';
                break;
        }
        $name = $request->input('goods_name');
        $price = $request->input('price')[0];
        $minimum = $request->input('minimum')[0];
        $number = $request->input('stock')[0];
        $kid = $request->input('cate_id');
        $member_id = session('mid');


        $tip = $request->input('description');
        $source = $request->input('baseaddress_options');



        $supply = new Supply;

        $supply->goods_name = $name;
        $supply->price = $price;
        $supply->number = $number;
        $supply->cutday = $cutday;
        $supply->source = $source;
        $supply->kid = $kid;
        $supply->addtime = time();

        //测试
        $supply->member_id = $member_id;
        $supply->imgs = '';
        $supply->is_emergency = 0;
        $supply->status = 0;

        $supply->imgs = $this->uploadfile($request);

        // 'id',
        // 'name',
        // 'price',
        // 'number',
        // 'cutday',
        // 'source',
        // 'kid',
        // 'member_id',
        // 'addtime',
        // 'imgs',
        // 'is_emergency' ,
        // 'status'
        $supply->save();
        $newid = $supply->id;

        //添加对应的属性值的表
        $attr = $request->input('attr');

        foreach($attr as $key=>$val)
        {
            $obj = new SupplyAttr;
            $obj->attribute_id = $key;
            $obj->supplys_id = $newid;
            $obj->attr_value = $val;
            $obj->save();
        }

        echo '<script>alert("发布商品成功!");location.href="/supply/index";</script>';



    }

    public function uploadfile(Request $request)
    {
        //要让文件能被访问到 php artisan storage:link 然后 huinong.app/storage/hehe.png
        $filepath = session('mid');
        //自动生成文件名
        $path = $request->file('imgs')->store('public/supply/'.$filepath);
        //手动生成文件名
        // $path = $request->file('imgs')->storeAs('public/want/',session('mid').'_'.date('YmdHis').'jpg');
        // /public/2017/10/18/J9bL2J8TQmuvLhRdYVhZxDcfYivv9cNEojANs1zY.png
        // return str_replace('public','storage', $path);
        return $path;

    }

}
