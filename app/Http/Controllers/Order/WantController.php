<?php

namespace App\Http\Controllers\Order;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Want;
use App\Model\WantAttr;
use App\Model\MemberAddress;
use EasyWeChat\Payment\Order;
use EasyWeChat\Foundation\Application;

//xixi
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

    public function uploadfile(Request $request)
    {
        //要让文件能被访问到 php artisan storage:link 然后 huinong.app/storage/hehe.png
        $filepath = session('mid');
        //自动生成文件名
        $path = $request->file('imgs')->store('public/want/'.$filepath);
        //手动生成文件名
        // $path = $request->file('imgs')->storeAs('public/want/',session('mid').'_'.date('YmdHis').'jpg');
        // /public/2017/10/18/J9bL2J8TQmuvLhRdYVhZxDcfYivv9cNEojANs1zY.png
        // return str_replace('public','storage', $path);
        return $path;

    }
    //压缩上传11
    public function resizeUpload(Request $request)
    {
        $base64_image_content = $request->input('compressValue');
        if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_image_content, $result)){
            $type = $result[2];
            // $root =
            // dump(public_path());
            // dump($_SERVER['DOCUMENT_ROOT']);
            // dd($_SERVER);
            $new_file = storage_path().'/app/public/want/'.session('mid').'/';

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
        }else{
            return false;
        }
    }

    //发布求购 增
    public function fabu(Request $request){
        // $this->validate();
        // exit;
        // return back()->withErrors(['email'=>'sdhfdsuifhu']);exit;
        if($request->isMethod('post'))
        {
            // return response()->json(['errNum'=>0]);
            //表单提交
            // dump($_FILES);
            // dd($request->all());
            $miaoy = $request->input('miaoy');
            $from_region_names = $request->input('from_region_names');
            $cate_id = $request->input('cate_id');
            $cate_name = $request->input('cate_name');
            $title = $request->input('title');
            $requirement_spec = $request->input('requirement_spec');
            $address_option = $request->input('address_option');
            $address_id = $request->input('address_id');
            $description = $request->input('description');
            // $emergency = $request->input('emergency');
            $expire = $request->input('expire');
            $out_trade_no = $request->input('out_trade_no');


            // 地址 自填 还是选择
            if($miaoy == '1')
            {
                //自己填写
                $from_region_id = $request->input('from_region_id');
                $from_region_names = $request->input('from_region_names');


            }elseif($miaoy == '2'){
                //选择框
                $from_region_id = $request->input('from_region_id');
                $from_region_names = $request->input('from_region_names');
                $region_name_select = $request->input('region_name_select');


            }else{
                dd('error');
            }

            // $imgs


            // $imgs = $this->uploadfile($request);
            if(!$imgs=$this->resizeUpload($request)) $imgs=config('common.img_default');



            $number = $requirement_spec['num'][0];

            $obj = new Want;
            $obj->source = $from_region_names;
            $obj->title = $title;
            $obj->number =$number;
            $obj->imgs = $imgs;
            $obj->tip =$description;
            // $obj->is_emergency = $emergency;
            $obj->cutday = strtotime($expire);
            $obj->status = 0;
            $obj->kid = $cate_id;
            $obj->member_id = session('mid');
            $obj->addtime = time();
            $obj->region_id = $from_region_id;

            $obj->address_id = $address_id;

            // $obj->address = $address_option;
            // $obj->address_id = $address_id;
            $obj->wx_out_trade_no = $out_trade_no;



            $attr = $requirement_spec['attr'];
            if($obj->save() && $attr){
                $wants_id = $obj->id;

                foreach($attr as $key=>$v){
                    if($v[0]){
                        $att = new WantAttr;
                        $att->attribute_id = $key;
                        $att->attr_value = $v[0];
                        $att->wants_id = $wants_id;
                        $att->save();
                    }

                }
            }

            return response()->json(['errMsg'=>'发布成功!','errNum'=>0]);
            // return response("<script>alert('发布成功!');location.href='/want/index'</script>");
            // attr spec
            //把属性加到 wantattr 里面


        }




        //调用我的地址里面的联系人

        $data = \App\Model\MemberAddress::where('mid' , session('mid'))->get(['full_address','region_id','street','phone','name','id'])->toArray();
        // dd($data);
        if(empty($data)) return response("<script>alert('请先添加你的收货人信息!');location.href='/member/address';</script>");
        $address = array();
        foreach($data as $val){
            $newarr = array();
            $newarr['id']=$val['id'];
            // $newarr['name']=$val['full_address']."\t".$val['street'];
            $newarr['name']=$val['name']."\t".$val['full_address'];
            // $newarr['member_address_id']=$val['id'];
            $address[] = $newarr;
        }
        $address_json = json_encode($address);




        //调用我的店铺 所填写的基地
        // $data = \App\Model\MemberStoreinfo::with('userinfo')->where('member_id' , session('mid'))->first()->toArray();
        //
        // $address = array();
        // $address['id'] = $data['region_id'];
        // // $address['name'] = $data['base_address']."\t".$data['street'];
        // $address['name'] = $data['userinfo']['tname']."\t".$data['base_address'];
        // $address['phone'] = $data['phone'];


        // $address_json = (json_encode($address));


        //支付sdk 信息包
        $user = session('wechat.oauth_user');
        $options=require config_path().'/wechat.php';
        $app = new Application($options);
        $js = $app->js;

        //订单详情
        $payment = $app->payment;
        // $prepayId = '123213213';
        // $config = $payment->configForJSSDKPayment($prepayId);
        // dump($js->config(array('onMenuShareQQ', 'onMenuShareWeibo','chooseWXPay'), true));
        // dd($config);


        $attributes = [
            'trade_type'       => 'JSAPI', // JSAPI，NATIVE，APP...
            'body'             => '求购信息佣金',
            'detail'           => '求购信息佣金十块钱',
            // 'out_trade_no'     => '1217752501201407033233368019',
            'out_trade_no'     => date('Ymdhis').strrand(5),
            'total_fee'        => config('common.fabu_want_price'), // 单位：分
            'notify_url'       => 'http://sj.71mh.com/wx/notify', // 支付结果通知网址，如果不设置则会使用配置里的默认地址
            'openid'           => $user->id, // trade_type=JSAPI，此参数必传，用户在商户appid下的唯一标识，
            // ...
        ];
        $order = new Order($attributes);

        $result = $payment->prepare($order);

        // dd($result);
        if ($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS'){
            $prepayId = $result->prepay_id;
            $config = $payment->configForJSSDKPayment($prepayId);
        }

        $out_trade_no = $attributes['out_trade_no'];

        // return view('wx.paybutton',['js'=>$js,'config'=>$config]);



        return view('home.want.fabu',['address_json'=>$address_json,'out_trade_no'=>$out_trade_no,'js'=>$js,'config'=>$config]);
    }

    //删除求购
    // public function delWant($wid)
    // {
    //     $rs = Want::where('id',$wid)->delete();
    //     if($rs) return back()->with('del_msg' , '删除成功');
    // }
    public function create()
    {
        $miaoy = $request->input('miaoy');
        $from_region_names = $request->input('from_region_names');
        $cate_id = $request->input('cate_id');
        $cate_name = $request->input('cate_name');
        $title = $request->input('title');
        $requirement_spec = $request->input('requirement_spec');
        $address_option = $request->input('address_option');
        $address_id = $request->input('address_id');
        $description = $request->input('description');
        // $emergency = $request->input('emergency');
        $expire = $request->input('expire');

        // 地址 自填 还是选择
        if($miaoy == '1')
        {
            //自己填写
            $from_region_id = $request->input('from_region_id');
            $from_region_names = $request->input('from_region_names');


        }elseif($miaoy == '2'){
            //选择框
            $from_region_id = $request->input('from_region_id');
            $from_region_names = $request->input('from_region_names');
            $region_name_select = $request->input('region_name_select');


        }else{
            dd('error');
        }

        // $imgs

        $imgs = $this->uploadfile($request);


        $number = $requirement_spec['num'][0];

        $obj = new Want;
        $obj->source = $from_region_names;
        $obj->title = $title;
        $obj->number =$number;
        $obj->imgs = $imgs;
        $obj->tip =$description;
        // $obj->is_emergency = $emergency;
        $obj->cutday = strtotime($expire);
        $obj->status = 0;
        $obj->kid = $cate_id;
        $obj->member_id = session('mid');
        $obj->addtime = time();
        $obj->region_id = $from_region_id;
        $obj->address = $address_option;
        $obj->address_id = $address_id;


        $attr = $requirement_spec['attr'];
        if($obj->save() && $attr){
            $wants_id = $obj->id;

            foreach($attr as $key=>$v){
                $att = new WantAttr;
                $att->attribute_id = $key;
                $att->attr_value = $v[0];
                $att->wants_id = $wants_id;
                $att->save();
            }
        }

        return response()->json(['errMsg'=>'发布成功!','errNum'=>0]);
    }

    //查看求购
    public function view()
    {


    }




    //编辑求购

    public function edit($wid)
    {
        $item = Want::where('id' , $wid)->first();
        $data = \App\Model\MemberStoreinfo::where('member_id' , session('mid'))->first(['base_address','region_id','street'])->toArray();
        $address = array();
        $address['id'] = $data['region_id'];
        $address['name'] = $data['base_address']."\t".$data['street'];

        $address_json = (json_encode($address));



        if($item) return view('home.want.edit' ,['item'=>$item,'address_json'=>$address_json]);
    }

    //删除求购
    public function delete($wid)
    {
        $rs = Want::where('id' , $wid)->delete();
        if($rs) return response("<script>alert('删除成功!');location.href='/want/my-want'</script>");

    }

    //我的求购
    public function myWant()
    {
        // $data = Want::with()->where('member_id',session('mid'))->get();
        $mid = session('mid');
        return view('home.want.my-want',['mid'=>$mid]);
    }





    //




}
