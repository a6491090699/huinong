<?php

namespace App\Http\Controllers\Order;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\SupplyOrder;
use App\Model\ShipInfo;

class SupplyOrderController extends Controller
{
    //
    //我的供货列表
    public function index(Request $request)
    {
        $type = $request->input('type')? $request->input('type'):'';
        if(empty($type)) $type = 'all_orders';
        //供应列表
        // $supplys = Supply::with('supplyAttrs.attrs','kinds')->where('member_id', session('mid'))->orderBy('id','desc')->paginate($pagenum);
        // $mid = session('mid');


        return view('home.supply.supply-order' ,['type'=>$type]);
    }

    public function edit($id){
        dd(12321);
        return view('home.supply.supply-order-edit');
    }

    //下单添加订单
    //库存减相对数量 售量加相对数量



    //商家销售订单 操作

    //点击取消订单
    public function cancel(Request $request)
    {
        // dd($request->all());
        if(!$request->has('id')) return response()->json(['status'=>'error','msg'=>'参数发生错误!']);
        $id = $request->input('id');
        $obj =SupplyOrder::where('id',$id)->first();

        $obj->status = 9;
        if($obj->save()) return response()->json(['status'=>'success','msg'=>'取消订单成功!']);
        return response()->json(['status'=>'fail','msg'=>'取消订单失败!']);



    }
    //点击确定接单 改变状态

    public function confirm(Request $request)
    {
        if(!$request->has('id')) return response()->json(['status'=>'error','msg'=>'参数发生错误!']);
        $id = $request->input('id');
        $obj =SupplyOrder::where('id',$id)->first();

        $obj->status = 1;
        if($obj->save()) return response()->json(['status'=>'success','msg'=>'确认订单成功!']);
        return response()->json(['status'=>'fail','msg'=>'确认订单失败!']);
    }

    //点击发货
    public function sended(Request $request)
    {
        if(!$request->has('id')) return response()->json(['status'=>'error','msg'=>'参数发生错误!']);
        $id = $request->input('id');
        $obj =SupplyOrder::where('id',$id)->first();

        $obj->status = 3;
        if($obj->save()) return response()->json(['status'=>'success','msg'=>'订单发货成功!']);
        return response()->json(['status'=>'fail','msg'=>'订单发货失败!']);
    }
    //删除订单
    public function del(Request $request)
    {
        if(!$request->has('id')) return response()->json(['status'=>'error','msg'=>'参数发生错误!']);
        $id = $request->input('id');
        $obj =SupplyOrder::where('id',$id)->first();

        if($obj->delete()) return response()->json(['status'=>'success','msg'=>'订单删除成功!']);
        return response()->json(['status'=>'fail','msg'=>'订单删除失败!']);
    }
    //点击查看评价




    // 添加物流信息 点击确认发货 跳转
    public function shipInfoAdd(Request $request){
        $ship_no = $request->input('ship_no');
        $tip = $request->input('tip');
        $compressValue = $request->input('compressValue');
        $order_id = $request->input('order_id');


        $c = ShipInfo::where('supply_orders_id',$order_id)->count();
        if($c) return response()->json(['status'=>'error','msg'=>'物流信息已经存在!']);
        $ship = new ShipInfo;
        $ship->ship_no = $ship_no;
        $ship->tip = $tip;
        $ship->supply_orders_id = $order_id;

        $imgs_rs = $this->multiUpload($request);
        if(empty($imgs_rs)) $imgs_rs = config('common.supply_lunbo_default');
        $ship->ship_imgs = $imgs_rs;
        if($ship->save()){
            $obj =SupplyOrder::where('id',$order_id)->first();

            $obj->status = 3;
            if($obj->save()) return response()->json(['status'=>'success','msg'=>'物流信息添加成功!确认订单成功!']);

        }else{
            return response()->json(['status'=>'error','msg'=>'操作失败!错误代码113.请联系客服']);
        }


    }
    public function shipInfoPage(Request $request)
    {
        if(!$request->has('order_id')) return response()->view('home.common.404',['msg'=>'参数发生错误 错误代码112!']);
        $order_id = $request->input('order_id');
        return view('home.supply.ship-info',['order_id'=>$order_id]);
    }


    public function multiUpload(Request $request)
    {

        $base64_image_content = $request->input('compressValue');
        if(empty($base64_image_content)) return '';
        $return = '';
        foreach($base64_image_content as $val){

            $return .= $this->singleUpload($val).';';

        }
        return $return;

    }
    public function singleUpload($compress)
    {
        if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $compress, $result)){
            $type = $result[2];
            // $root =
            // dump(public_path());
            // dump($_SERVER['DOCUMENT_ROOT']);
            // dd($_SERVER);
            $new_file = storage_path().'/app/public/supply/'.session('mid').'/';

            //如果文件不存在,则创建
            if(!file_exists($new_file))
            {
                mkdir($new_file, 0777, true);
            }

            $new_file = $new_file.time().strrand(5). '.' .$type;
            if (file_put_contents($new_file, base64_decode(str_replace($result[1],'', $compress)))){
                $return = str_replace(storage_path().'/app/' ,'',$new_file);
                return $return;
                // return 'public/'.
            }else{
                return '';
            }
        }
    }


}
