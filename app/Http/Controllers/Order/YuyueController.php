<?php

namespace App\Http\Controllers\Order;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Yuyue;

class YuyueController extends Controller
{
    //
    public function create(Request $request)
    {
        // dd($request->all());
        $good_id = $request->good_id;
        $yuyue_name = $request->yuyue_name;
        $yuyue_phone = $request->yuyue_phone;
        $start_data = $request->start_data;
        $end_data = $request->end_data;
        $obj = new Yuyue;
        $obj->supplys_id = $good_id;
        $obj->name = $yuyue_name;
        $obj->phone = $yuyue_phone;
        $obj->start_data = $start_data;
        $obj->end_data = $end_data;
        $obj->status = 0;
        $obj->member_id = session('mid');
        $rs =$obj->save();
        if($rs) return response('<script>alert("预约成功!");location.href="/supply/view/'.$good_id.'"</script>');

        return response()->view('home.common.404', ['msg'=>'创建预约出错!'] ,404);
    }

    //我的预约
    public function myYuyue(Request $request)
    {
        $mid = session('mid');
        $type = $request->input('type');
        // $data = Yuyue::with('supply')->where('mid',$mid)->get();
        if(empty($type)) $type ='all';
        return view('home.yuyue.my-yuyue' , ['type'=>$type]);
    }
    //别人对我的预约

    public function othersYuyue(Request $request)
    {
        $mid = session('mid');
        $type = $request->input('type');
        // $data = Yuyue::with('supply')->where('mid',$mid)->get();
        if(empty($type)) $type ='all';
        return view('home.yuyue.others-yuyue' , ['type'=>$type]);
    }

    //my
    //取消预约

    public function cancel($id)
    {
        $item = Yuyue::where('id',$id)->first();
        $item->status = 9;
        if($item->save()) return response('<script>alert("取消成功!");location.href="/yuyue/my-yuyue"</script>');
        return response()->view('home.common.404', ['msg'=>'取消预约发生错误!'] ,404);

    }

    //确认看货
    public function looked($id)
    {
        $item = Yuyue::where('id' , $id)->first();
        $item->status = 2;
        if($item->save()) return response('<script>alert("已完成看货!");location.href="/yuyue/my-yuyue"</script>');
        return response()->view('home.common.404', ['msg'=>'已完成看货发生错误!'] ,404);
    }

    //评价页面
    public function comment($id)
    {
        $item = Yuyue::where('id' , $id)->first();
        $item->status = 3;

        //test
        if($item->save()) return response('<script>alert("评价成功!");location.href="/yuyue/my-yuyue"</script>');
        return response()->view('home.common.404', ['msg'=>'评价发生错误!'] ,404);
        // return view('home.yuyue.comment');
    }

    //评价
    public function addComment(Request $request)
    {
        // $item = Yuyue::where('id' , $id)->first();
        // $item->status = 3;
        // if($item->save()) return response('<script>alert("评价成功!");location.href="/yuyue/my-yuyue"</script>');
        // return response()->view('home.common.404', ['msg'=>'评价发生错误!'] ,404);
    }









    //others
    //删除预约

    public function delete($id)
    {
        $item = Yuyue::where('id',$id)->delete();
        if($item) return response('<script>alert("删除成功!");location.href="/yuyue/others-yuyue"</script>');
        return response()->view('home.common.404', ['msg'=>'删除预约发生错误!'] ,404);
    }


    //确认预约申请
    public function confirm(Request $request)
    {
        $id = $request->input('id');
        $message = $request->input('message');

        $item = Yuyue::where('id',$id)->first();
        $item->message = $message;
        $item->status = 1;
        if($item->save()) return response('<script>alert("确认申请成功!");location.href="/yuyue/others-yuyue"</script>');
        return response()->view('home.common.404', ['msg'=>'确认申请发生错误!'] ,404);

    }

}
