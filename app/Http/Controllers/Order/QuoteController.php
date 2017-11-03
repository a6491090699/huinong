<?php

namespace App\Http\Controllers\Order;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Quote;
use App\Model\Want;

class QuoteController extends Controller
{
    //

    public function addQuote($id)
    {

        $wdata = Want::with('wantAttrs.attrs','quotes')->where('id',$id)->first();

        return view('home.quote.add',['wid'=> $id , 'wdata'=>$wdata]);


    }

    public function createQuote(Request $request)
    {

        // if(!$request->isMethod('post')) die(404);
        // dd($request->all());
        $mid = session('mid')?session('mid'):1;
        $new = new Quote();
        if($new->where('member_id',$mid)->where('wants_id',$request->input('wid'))->count()) {
            // return json_encode(array(
            //     'errMsg'=>'你已报价!!'
            //
            // ));
            return response()->json(['errMsg' => '你已报价!']);
        }
        $new->member_id = $mid;
        $new->price = $request->input('price');
        $new->number = $request->input('number');
        $new->beihuo_time = $request->input('beihuo');
        $new->fapiao_type = $request->input('fapiao_type');
        $new->addtime = time();
        $new->wants_id = $request->input('wid');
        if($new->save()){
            return response()->json(['errMsg' => '报价成功!']);

            // return json_encode(array(
            //     'errMsg'=>'报价成功!'
            // ));
        }else{
            return response()->json(['errMsg' => '报价失败,请重试!' ,'errNum'=>0]);

            // return json_encode(array(
            //     'errMsg'=>'报价失败! 请重试 !',
            //     'errNum'=>0
            // ));
        }


        dd($request->all());



    }

    public function myQuote()
    {

        $mid = session('mid')?session('mid'):1;
        $data = Quote::with('wants')->where('member_id' , $mid)->get();
        return view('home.quote.my');
    }
    public function myQuotePass()
    {

        $mid = session('mid')?session('mid'):1;
        $data = Quote::with('wants')->where('member_id' , $mid)->where('status','1')->get();
        return view('home.quote.my-pass');
    }
    public function myQuoteNoPass()
    {

        $mid = session('mid')?session('mid'):1;
        $data = Quote::with('wants')->where('member_id' , $mid)->where('status','2')->get();
        return view('home.quote.my-nopass');
    }
    public function myQuoteLose()
    {

        $mid = session('mid')?session('mid'):1;
        $data = Quote::with('wants')->where('member_id' , $mid)->where('status','3')->get();
        return view('home.quote.my-lose');
    }

}
