<?php

namespace App\Http\Controllers\Order;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Supply;
use App\Model\SupplyAttr;
use App\Model\MemberStoreinfo;

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
        // dd($base_address);exit;
        return view('home.supply.add',['base_address'=>$base_address]);
    }

    public function editSupply()
    {
        return view('home.supply.edit');
    }

    public function viewSupply($id)
    {
        $data = Supply::with('supplyAttrs.attrs','kinds')->where('id' ,$id)->first();
        return view('home.supply.view' ,['item'=>$data]);
    }
    public function create(Request $request)
    {
        // dd($request->all());
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
        $member_id = session('mid')?session('mid'):1;


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

}
