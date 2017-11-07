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
        return view('home.member.address_add');
    }
    //
    public function addressDel(Request $request)
    {
        dd($request->all());
    }
    //
    public function addressCreate(Request $request)
    {
        dd($request->all());

    }
    //
    public function addressSave(Request $request)
    {
        dd($request->all());

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
