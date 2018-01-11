<?php
//yyyyyyyyyyyyyyyyyyy中间件的问题 导致了收不到回调
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Http\Request;
use Henter\WeChat\OAuth;
use App\Model\Want;
use App\Model\Supply;
use App\Model\Member;
use App\Model\Kind;
use EasyWeChat\Factory;


// session(['mid'=>1]);

//发送模板消息

function send_template_msg($template_id , $redirect_url , $data , $send_openid){

    $app = app('wechat');
    $notice = $app->notice;
    $notice->uses($template_id)->withUrl($redirect_url)->andData($data)->andReceiver($send_openid)->send();

}

//从kid 获取 全名称
function getFullCate($kid)
{
    static $arr=array();

    $data = Kind::where('id',$kid)->first(['pid','name']);
    // dump($data->name.'|'.$data->pid);
    array_unshift($arr , $data->name);
    if($data->pid){
        getFullCate($data->pid);
    }
    // dump(implode("\t",$arr));
    return implode(" ",$arr);
}
//从kid 获取 全名称
function getFullId($kid)
{
    static $arr=array();

    $data = Kind::where('id',$kid)->first(['pid','name','id']);
    // dump($data->name.'|'.$data->pid);
    array_unshift($arr , $data->id);
    if($data->pid){
        getFullId($data->pid);
    }
    // dump(implode(",",$arr));
    return implode(",",$arr);
}

//在这边获取openid
function getOpenid()
{
    //测试
    // return 'hehe123';
    $appid = config('wechat.appid');
    $appsecret = config('wechat.appsecret');
    if(!empty($_GET['code'])){
        $api = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='.$appsecret.'&code='.$code.'&grant_type=authorization_code ';
        $ch = curl_init();
        curl_setopt($ch , CURLOPT_URL ,$api);
        curl_setopt($ch , CURLOPT_HEADER , false);
        curl_setopt($ch , CURLOPT_RETURNTRANSFER , 1);
        $data = curl_exec();
        $data = json_decode($data , true);
        if(isset($data['errcode'])){
            dd('获取openid 发生错误!'.$data['errmsg']);
        }
        $openid = $data['openid'];
        return $openid;
    }else{
        $redirect_url = urlencode('http://sj.71mh.com/index.php');
        header('Location:https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$appid.'&redirect_uri='.$redirect_url.'&response_type=code&scope=snsapi_base&state=123#wechat_redirect ');
    }
}

function strrand($len)
{
    $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';
    $string=time();
    for(;$len>=1;$len--)
    {
        $position=rand()%strlen($chars);
        $position2=rand()%strlen($string);
        $string=substr_replace($string,substr($chars,$position,1),$position2,0);
     }
     return $string;
 }


function formate_time($time){
    $now = time();
    $today = strtotime(date('Y-m-d'));
    // $yesterday = $today - 60*60*24;
    $string = date('Y-m-d' , $time);
    if(($now-$time)<60) $string = '刚刚';
    if(($now-$time)>=60 && ($now-$time)<60*60) $string = floor(($now-$time)/60).'分钟前';
    if(($now-$time)>=3600 && ($now-$time)<60*60*24) $string = floor(($now-$time)/3600).'小时前';
    if(($now-$time)>=60*60*24 && ($now-$time)<60*60*24*2) $string = '昨天';
    return $string;
}

function get_sub_value($array, $value , $param = 'id') {
    if (!is_array($array)) return null;
    //一维
    if (isset($array[$param]) && $array[$param]==$value) return $array;
    //多维
    foreach ($array as $item) {
        $return = get_sub_value($item, $value , $param = 'id');
        if (!is_null($return)) {
            return $return;
        }
    }
    return null;
}
function getPic($string=''){
    return str_replace('public/','/storage/', $string);
}
function showImgs($string=''){
    $string = trim($string , ';');
    $arr = explode(';',$string);
    $html = '';
    foreach($arr as  $val){
        $html.= '<img src="'.getPic($val).'" style="width:100%">';
    }
    return $html;
    // return str_replace('public/','/storage/', $string);
}
function xinyongStar($number){
    $num = floor($number);
    $light_star = '<img src="/images/star_1.png" height="12px">';
    $black_star = '<img src="/images/star_1h.png" height="12px">';
    $total = 5;
    $html = '';
    $html = str_repeat($light_star , $num) .str_repeat($black_star , $total-$num);
    return $html;

}


function getSonList($arr, $fid){
    // foreach($arr as $val){
    //
    // }
    static $res;
    if(is_array($arr) && isset($arr['id']) && !empty($arr['id']) && !empty($arr['child'])){
        if($arr['id'] == $fid){
            $res=$arr['child'];
            return;

        }else{
            foreach($arr['child'] as $val){
                getSonList($val,$fid);
            }
        }

    }elseif(is_array($arr) && !isset($arr['id'])){
        foreach($arr as $val){

            getSonList($val,$fid);
        }

    }
    return $res;


    //
    // foreach($arr as $val){
    //     // dump($val['name']);
    //     if($val['id'] == $fid){
    //         return $val['child'];
    //     }else{
    //         if(isset($val['child'])) return getSonList($val['child'] , $fid);
    //     }
    //
    //
    // }

}
function getSon($arr,$str='')
{
    static $str='';
    if(is_array($arr) && isset($arr['id']) && !empty($arr['id']) && !empty($arr['child'])){
        $str .= $arr['id'].',';
        foreach($arr['child'] as $val){
            getSon($val ,$str);
        }

    }elseif(is_array($arr) && !isset($arr['id'])){
        foreach($arr as $val){
            // dump($val);
            getSon($val ,$str);
        }
    }else{
        // dump('here'.$arr['id']);
        $str .= $arr['id'].',';
    }
    return $str;
}


Route::get('/', function () {



    $wdata = Want::with('wantAttrs.attrs','kinds','quotes')->where('cutday','>',time())->limit(6)->OrderBy('id','desc')->get();
    $supplys = Supply::with('supplyAttrs.attrs','kinds','member','storeinfo')->where('cutday','>',time())->limit(6)->OrderBy('id','desc')->get();
    return view('home.index' , ['wdata'=>$wdata , 'supplys'=>$supplys]);
});
// Route::get('/home' , function(){
//     $appid = config('wechat.appid');
//     $secret = config('wechat.appsecret');
//     $oauth = new \Henter\WeChat\OAuth($appid, $secret);
//     $callback_url = 'http://your_site.com/your_callback_url';
//     $url = $oauth->getAuthorizeURL($callback_url);
//
// });
// Route::get('uploadform' , function(){
//     // echo asset('storage/hehe.png');exit;
//     return view('upload');
// });

//发布求购
Route::group(['namespace'=>'Order' ,'prefix'=>'want' ] ,function (){
    Route::get('index' , 'WantController@index');
    Route::get('fabu' , 'WantController@fabu');
    Route::post('fabu' , 'WantController@fabu');
    Route::post('create' , 'WantController@create');

    Route::get('my-want' , 'WantController@myWant');
    Route::get('edit/{id}' , 'WantController@edit');
    Route::post('save' , 'WantController@save');
    Route::get('delete/{id}' , 'WantController@delete');
    Route::get('view/{id}' , 'WantController@view');


    Route::any('notify', 'WantController@notify');
    Route::any('jsapi', 'WantController@jsapi');
    Route::any('wantindex', 'WantController@wantindex');



});
//报价
Route::group(['namespace'=>'Order' ,'prefix'=>'quote'] ,function (){
    Route::get('add/{id}' , 'QuoteController@addQuote');
    Route::post('create' , 'QuoteController@createQuote');
    Route::get('my' , 'QuoteController@myQuote');
    Route::get('my-pass' , 'QuoteController@myQuotePass');
    Route::get('my-nopass' , 'QuoteController@myQuoteNopass');
    Route::get('my-lose' , 'QuoteController@myQuoteLose');


});

//商品供应
Route::group(['namespace'=>'Order' ,'prefix'=>'supply'] ,function (){
    Route::get('index' , 'SupplyController@index');
    Route::get('search' , 'SupplyController@search');
    Route::get('add' , 'SupplyController@addSupply')->middleware('no.storeinfo');
    // Route::get('edit' , 'SupplyController@addSupply');
    Route::get('view/{id}' , 'SupplyController@viewSupply');
    Route::post('create' , 'SupplyController@create')->middleware('no.storeinfo');



});

//商品预约看货
Route::group(['namespace'=>'Order' ,'prefix'=>'yuyue'] ,function (){
    Route::post('create' , 'YuyueController@create');
    Route::get('my-yuyue' , 'YuyueController@myYuyue');
    Route::get('others-yuyue' , 'YuyueController@othersYuyue')->middleware('no.storeinfo');
    Route::get('delete/{id}' , 'YuyueController@delete');
    Route::get('cancel/{id}' , 'YuyueController@cancel');
    Route::get('confirm' , 'YuyueController@confirm');

    Route::get('looked/{id}' , 'YuyueController@looked');
    Route::get('comment/{id}' , 'YuyueController@comment');
    Route::post('add-comment' , 'YuyueController@addComment');
    // Route::get('add/' , 'YuyueController@add');



});

//店铺操作
// Route::get('store/add' , 'Order\StoreController@addStoreinfo');
Route::group(['namespace'=>'Order' ,'prefix'=>'store'] ,function (){
    Route::get('add' , 'StoreController@addStoreinfo');
    Route::get('edit' , 'StoreController@editStore')->middleware('no.storeinfo');
    Route::post('save' , 'StoreController@saveStore')->middleware('no.storeinfo');
    Route::get('index' , 'StoreController@index')->middleware('no.storeinfo');
    Route::get('showinfo' , 'StoreController@showinfo');

    Route::get('view/{id}' , 'StoreController@view');
    Route::post('create' , 'StoreController@create');
    Route::post('check-name' , 'StoreController@checkName');
    Route::post('upload-imgs' , 'StoreController@uploadImgs');
    Route::post('reset-imgs' , 'StoreController@resetImgs');




});
// /index.php?app=mlselection&act=regions4app&up_level=4
//会员中心
Route::group(['namespace'=>'Order' ,'prefix'=>'member'] ,function (){
    Route::get('address', 'MemberController@address');
    Route::get('collect', 'MemberController@collect');
    Route::get('id-valid', 'MemberController@idValid');
    Route::get('index', 'MemberController@index');
    Route::get('info', 'MemberController@info');
    Route::get('setting', 'MemberController@setting');
    // Route::get('vip', 'MemberController@vip');
    Route::get('jingying-valid', 'MemberController@jingyingValid');
    Route::get('valid-index', 'MemberController@validIndex');
    Route::get('xieyi', 'MemberController@xieyi');

    //地址编辑
    Route::get('address-edit/{id}', 'MemberController@addressEdit');
    Route::get('address-add', 'MemberController@addressAdd');
    Route::any('address-del', 'MemberController@addressDel');
    Route::post('address-create', 'MemberController@addressCreate');
    Route::post('address-save', 'MemberController@addressSave');
    Route::post('address-setdefault', 'MemberController@setdefault');

    //Order list
    Route::get('want-order' , 'MemberController@wantOrder');

    //supply Order list
    //全部订单
    Route::get('supply-order' , 'MemberController@supplyOrder');
    // Route::get('supply-order-pending' , 'MemberController@supplyOrderPending');
    // Route::get('supply-order-accepted' , 'MemberController@supplyOrderAccepted');
    // Route::get('supply-order-shipped' , 'MemberController@supplyOrderShipped');
    // Route::get('supply-order-finished' , 'MemberController@supplyOrderFinished');

    Route::get('my-goods' , 'MemberController@myGoods')->middleware('no.storeinfo');

});
Route::group(['namespace'=>'Order' ,'prefix'=>'supplyorder','middleware'=>'no.storeinfo'] ,function (){


    //supply Order list
    //全部订单
    Route::get('index' , 'SupplyOrderController@index');
    Route::get('edit/{id}' , 'SupplyOrderController@edit');

    //商家销售订单操作
    Route::post('cancel' , 'SupplyOrderController@cancel');
    Route::post('confirm' , 'SupplyOrderController@confirm');
    Route::post('sended', 'SupplyOrderController@sended' );
    Route::post('del', 'SupplyOrderController@del' );
    // Route::get('comment-view/{id}' , 'SupplyOrderController@commentView');

    Route::post('ship-info-add', 'SupplyOrderController@shipInfoAdd' );
    Route::get('ship-info-page', 'SupplyOrderController@shipInfoPage' );




    //处理发货
    // Route::get('supply-order-pending' , 'MemberController@supplyOrderPending');
    // Route::get('supply-order-accepted' , 'MemberController@supplyOrderAccepted');
    // Route::get('supply-order-shipped' , 'MemberController@supplyOrderShipped');
    // Route::get('supply-order-finished' , 'MemberController@supplyOrderFinished');


});
Route::group(['namespace'=>'Order' ,'prefix'=>'buyorder'] ,function (){


    //supply Order list
    //全部订单
    Route::get('index' , 'BuyOrderController@index');


    //商家销售订单操作
    Route::get('pay/{id}' , 'BuyOrderController@pay');
    Route::post('received' , 'BuyOrderController@received');
    Route::get('comment/{id}', 'BuyOrderController@comment' );
    Route::post('del', 'BuyOrderController@del' );



});



Route::get('test',function(){

    return view('home.supply.ship-info');


});
//微信支付测试


Route::group(['prefix'=>'wx' ] ,function (){
    Route::any('index', 'WxController@index');
    Route::any('jsapi', 'WxController@jsapi');

    Route::any('notify', 'WxController@notify');
    Route::any('wantnotify', 'WxController@wantnotify');

    Route::any('vip', 'WxController@vip');
    Route::any('member-notify', 'WxController@memberNotify');
    Route::any('supply-notify', 'WxController@supplyNotify');

    Route::any('cart/{id}' , 'WxController@cart');
    Route::post('buy' , 'WxController@buy');
    Route::post('supply-order-create' , 'WxController@supplyOrderCreate');


    Route::get('want-fabu' , 'WxController@wantFabu');
    Route::get('supply-fabu' , 'WxController@supplyFabu')->middleware('no.storeinfo');
    Route::get('buy-good-page' , 'WxController@buyGoodPage');

    Route::get('buy-notify' , 'WxController@buyNotify');


    Route::get('pay-bzj' , 'WxController@payBzj');





});




//获取数据异步接口
Route::group(['namespace'=>'Api' ,'prefix'=>'api'] ,function (){
    Route::get('kinds' , 'DataController@getKinds');
    Route::get('attribute' , 'DataController@getAttribute');
    Route::get('city' , 'DataController@getCity');
    Route::get('get-want-list' , 'DataController@getMemberWantList');
    Route::get('want-list' , 'DataController@getWantList');
    Route::get('quote-all' , 'DataController@getQuote');
    Route::get('supply-all' , 'DataController@getSupplyAll');
    Route::get('sub-city' , 'DataController@getSubCity');
    Route::get('sub-region' , 'DataController@getSubRegion');
    Route::get('collect-store' , 'DataController@collectStore');
    Route::get('cancel-collect-store' , 'DataController@cancelCollectStore');
    Route::get('collect-good' , 'DataController@collectGood');
    Route::get('cancel-collect-good' , 'DataController@cancelCollectGood');
    Route::get('get-kind-unit/{kid}' , 'DataController@getKindUnit');
    Route::get('get-supply-order' , 'DataController@getSupplyOrder');
    Route::get('get-buy-order' , 'DataController@getBuyOrder');
    Route::get('get-yuyue' , 'DataController@getYuyue');
    // Route::get('get-my-want' , 'DataController@getMyWant');

});


//处理上传图片
Route::post('/uploadfile' , 'User\UserSettingController@uploadfile');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
