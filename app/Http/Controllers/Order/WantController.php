<?php

namespace App\Http\Controllers\Order;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Want;
use App\Model\WantAttr;
use App\Model\MemberAddress;

class WantController extends Controller
{
    //求购大厅列表
    public function index(){
        // $data = Want::with('wantAttrs')->get();
        // dump(Want::with('wantAttrs.attrs.kinds')->get()->toArray());
        // dump(WantAttr::with('attrs')->get()->toArray());
        // dump($data);
        //
        // // dump($data->want_attrs);
        // foreach ($data as $book) {
        //     dump($book->wantAttrs);
        // }
        //
        // dump($data->toArray());
        //
        //
        //
        // exit;
        return view('home.want.index');
    }

    //发布求购 增
    public function fabu(Request $request){
        // $this->validate();
        // exit;
        // return back()->withErrors(['email'=>'sdhfdsuifhu']);exit;
        if($request->isMethod('post'))
        {
            //表单提交
            $obj = new Want;
            $data = array(
                '123'
            );
        }
        $mid = 1;//session
        $address= MemberAddress::getAddress($mid);
        $val = array(); //
        foreach ($address as $val){
            $arr = array(
                'id'=>$val['id'],
                'name'=>$val['province'].' '.$val['city'] .' '.$val['part'].' '.$val['street']
            );
            $val[] = $arr;
        }
        $address_json = json_encode($val);

        session(['mid'=>1]);
        // dd(session('mid'));



        return view('home.want.fabu');
    }

    //删除求购
    public function delWant($wid)
    {
        $rs = Want::where('id',$wid)->delete();
        if($rs) return back()->with('del_msg' , '删除成功');
    }

    //查看求购
    public function viewWant(Request $request)
    {
        $wid = $request->input('id');
        $rs = Want::where('id',$wid)->first();
        dd($rs);
        return view();
    }


    //编辑求购

    public function eidtWant($wid)
    {

    }




    //




}
