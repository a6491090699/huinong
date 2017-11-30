<?php

namespace App\Http\Controllers\Order;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Supply;
use App\Model\SupplyAttr;
use App\Model\MemberStoreinfo;
use App\Model\GoodCollect;
use EasyWeChat\Payment\Order;
use EasyWeChat\Foundation\Application;

class SupplyController extends Controller
{
    //
    public function index()
    {

        return view('home.supply.index');
    }

    public function addSupply()
    {
        // dump(session('mid'));
        $base_address = MemberStoreinfo::where('member_id' ,session('mid'))->select('base_address','region_id')->get()->toJson();
        // dd($base_address->region_id);
        //支付sdk 信息包
        $user = session('wechat.oauth_user');
        $options=require config_path().'/wechat.php';
        $app = new Application($options);
        $js = $app->js;

        //订单详情
        $payment = $app->payment;

        $attributes = [
            'trade_type'       => 'JSAPI', // JSAPI，NATIVE，APP...
            'body'             => '发布商品信息佣金',
            'detail'           => '发布商品信息佣金十块钱',
            // 'out_trade_no'     => '1217752501201407033233368019',
            'out_trade_no'     => date('Ymdhis').strrand(5),
            'total_fee'        => config('common.fabu_supply_price'), // 单位：分
            'notify_url'       => 'http://sj.71mh.com/api/wx/supply-notify', // 支付结果通知网址，如果不设置则会使用配置里的默认地址
            'openid'           => $user->id, // trade_type=JSAPI，此参数必传，用户在商户appid下的唯一标识，
            // ...
        ];
        $order = new Order($attributes);

        $result = $payment->prepare($order);

        if ($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS'){
            $prepayId = $result->prepay_id;
            $config = $payment->configForJSSDKPayment($prepayId);
        }

        $out_trade_no = $attributes['out_trade_no'];


        return view('home.supply.add',['base_address'=>$base_address,'out_trade_no'=>$out_trade_no,'js'=>$js,'config'=>$config]);
    }

    public function editSupply()
    {
        return view('home.supply.edit');
    }

    public function viewSupply($id)
    {
        $data = Supply::with('supplyAttrs.attrs','kinds','storeinfo')->withCount('yuyue')->where('id' ,$id)->first();

        $is_collect = GoodCollect::where('good_id',$id)->where('member_id',session('mid'))->count();

        // 商品推荐
        $member_id = $data->member_id;
        $tuijian = Supply::with('kinds')->where('member_id',$member_id)->where('id','<>',$id)->limit(10)->orderBy('id','desc')->get();
        // dd($data->toArray());
        // dd($tuijian->toArray());
        return view('home.supply.view' ,['item'=>$data ,'is_collect'=>$is_collect,'tuijian'=>$tuijian]);
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

    public function create(Request $request)
    {
        // dump($request->all());
        $imgs = $this->multiUpload($request);
        dump($imgs);exit;
        dd($request->all());
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
        $out_trade_no = $request->input('out_trade_no');
        $emergency = $request->input('emergency');
        $name = $request->input('goods_name');
        $price = $request->input('price')[0];
        $minimum = $request->input('minimum')[0];
        $number = $request->input('stock')[0];
        $kid = $request->input('cate_id');
        $baseaddress_id = $request->input('baseaddress_id');

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
        $supply->base_region_id = $baseaddress_id;
        $supply->minimum = $minimum;


        $supply->member_id = $member_id;
        $supply->is_emergency = 0;
        $supply->status = 0;
        $supply->imgs = $this->multiUpload($request);
        $supply->wx_out_trade_no = $out_trade_no;
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
        if($emergency){
            return response()->json(['status'=>'1','errMsg'=>'发布紧急商品成功','call_pay'=>1]);
        }else{
            return response()->json(['status'=>'1','errMsg'=>'发布商品成功','call_pay'=>0]);
        }




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
