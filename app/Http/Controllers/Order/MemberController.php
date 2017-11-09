<?php

namespace App\Http\Controllers\Order;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\MemberStoreinfo;
use App\Model\MemberAddress;

class MemberController extends Controller
{
    //
    public function addressEdit($id)
    {
        $item = MemberAddress::where('id' ,$id)->first();
        return view('home.member.address_edit' ,['item'=>$item]);
    }
    //
    public function addressAdd()
    {
        $data = file_get_contents(app_path('Common/region.json'));
        $data = json_decode($data,true);

        return view('home.member.address_add',['region_data'=>$data]);
    }
    //
    public function addressDel(Request $request)
    {
        $id = $request->input('id');
        $rs = MemberAddress::where('id',$id)->delete();
        if($rs){
            return response()->json(['msg'=>'删除成功!','status'=>'success']);
        }else{
            return response()->json(['msg'=>'删除失败,请重试!','status'=>'error']);
        }
        dd($id);
    }
    //
    public function addressSave(Request $request)
    {

        // dd($request->all());
        $id = $request->input('addr_id');
        $name = $request->input('consignee');
        $phone = $request->input('phone_mob');
        $tel = $request->input('phone_tel');
        $full_address = $request->input('region_name');
        $region_id = $request->input('region_id');
        if($request->has('is_default')){
            $is_default = $request->input('is_default');

        }else{
            $is_default =0;
        }
        $street = $request->input('address');
        //如果设为默认 查询数据库 把其他的isdefault 全变为0
        if($is_default){
            MemberAddress::where('mid',session('mid'))->update(['is_default'=>0]);
        }
        //没有设置默认就添加
        $md =MemberAddress::where('id' ,$id)->first();
        $md->name = $name;
        $md->phone = $phone;
        $md->tel = $tel;
        $md->full_address = $full_address;
        $md->region_id = $region_id;
        $md->is_default = $is_default;
        $md->street = $street;
        $md->mid = session('mid');
        $rs = $md->save();
        if($rs){
            return response()->json(['msg'=>'保存成功!','status'=>'success']);

        }else{
            return response()->json(['msg'=>'保存成功!','status'=>'error']);
        }


    }

    //
    public function addressCreate(Request $request)
    {
        // dd($request->all());
        $name = $request->input('consignee');
        $phone = $request->input('phone_mob');
        $tel = $request->input('phone_tel');
        $full_address = $request->input('region_name');
        $region_id = $request->input('region_id');
        if($request->has('is_default')){
            $is_default = $request->input('is_default');

        }else{
            $is_default =0;
        }
        $street = $request->input('address');

        //如果设为默认 查询数据库 把其他的isdefault 全变为0
        if($is_default){
            MemberAddress::where('mid',session('mid'))->update(['is_default'=>0]);
        }
        //没有设置默认就添加
        $md =new MemberAddress;
        $md->name = $name;
        $md->phone = $phone;
        $md->tel = $tel;
        $md->full_address = $full_address;
        $md->region_id = $region_id;
        $md->is_default = $is_default;
        $md->street = $street;
        $md->mid = session('mid');
        $rs = $md->save();
        if($rs){
            return response('<script>alert("添加成功!");location.href="/member/address"</script>');

        }else{
            return response('error', 400);
        }



    }

    public function setdefault(Request $request){
        $id = $request->input('id');
        MemberAddress::where('mid' , session('mid'))->update(['is_default'=>0]);
        $rs = MemberAddress::where('id' ,$id)->update(['is_default'=>1]);
        if($rs){
            return response()->json(['msg'=>'设置成功','status'=>'success']);
        }else{
            return response()->json(['msg'=>'设置失败!请重试!','status'=>'error']);
        }

    }



    //
    public function address()
    {
        $addr = MemberAddress::where('mid',session('mid'))->get();
        return view('home.member.address' ,['addr'=>$addr]);
    }





    //
    public function collect()
    {
        return view('home.member.collect');
    }


    //
    public function idValid()
    {
        return view('home.member.id_valid');
    }


    //
    public function index()
    {
        //logo 名字
        // $store = MemberStoreinfo::where('member_id' ,session('mid'))->first();

        return view('home.member.index');
    }


    //
    public function info()
    {
        return view('home.member.info');
    }


    //
    public function jingyingValid()
    {
        return view('home.member.jingying_valid');
    }


    //
    public function setting()
    {
        return view('home.member.setting');
    }


    //
    public function validIndex()
    {
        return view('home.member.valid_index');
    }


    //
    public function vip()
    {
        return view('home.member.vip');
    }


}
