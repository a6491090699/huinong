<?php

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


session(['mid'=>1]);
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
Route::get('/', function () {

    $wdata = Want::with('wantAttrs.attrs','kinds','quotes')->limit(6)->get();
    $supplys = Supply::with('supplyAttrs.attrs','kinds')->limit(6)->get();
    return view('home.index' , ['wdata'=>$wdata , 'supplys'=>$supplys]);
});
Route::get('/home' , function(){
    $appid = config('wechat.appid');
    $secret = config('wechat.appsecret');
    $oauth = new \Henter\WeChat\OAuth($appid, $secret);
    $callback_url = 'http://your_site.com/your_callback_url';
    $url = $oauth->getAuthorizeURL($callback_url);

});
Route::get('uploadform' , function(){
    // echo asset('storage/hehe.png');exit;
    return view('upload');
});

//发布求购
Route::group(['namespace'=>'order' ,'prefix'=>'want'] ,function (){
    Route::get('index' , 'WantController@index');
    Route::get('fabu' , 'WantController@fabu');
    Route::post('fabu' , 'WantController@fabu');
    Route::get('view' , 'WantController@viewWant');

});
//报价
Route::group(['namespace'=>'order' ,'prefix'=>'quote'] ,function (){
    Route::get('add/{id}' , 'QuoteController@addQuote');
    Route::post('create' , 'QuoteController@createQuote');
    Route::get('my' , 'QuoteController@myQuote');
    Route::get('my-pass' , 'QuoteController@myQuotePass');
    Route::get('my-nopass' , 'QuoteController@myQuoteNopass');
    Route::get('my-lose' , 'QuoteController@myQuoteLose');


});

//商品供应
Route::group(['namespace'=>'order' ,'prefix'=>'supply'] ,function (){
    Route::get('index' , 'SupplyController@index');
    Route::get('add' , 'SupplyController@addSupply');
    Route::get('edit' , 'SupplyController@addSupply');
    Route::get('view/{id}' , 'SupplyController@viewSupply');
    Route::post('create' , 'SupplyController@create');



});

//店铺操作
Route::group(['namespace'=>'order' ,'prefix'=>'store'] ,function (){
    Route::get('edit' , 'StoreController@editStore');
    Route::get('index' , 'StoreController@index');
    Route::get('showinfo' , 'StoreController@showinfo');
    Route::get('add' , 'StoreController@addStoreinfo');
    Route::post('create' , 'StoreController@create');




});

//会员中心
Route::group(['namespace'=>'order' ,'prefix'=>'member'] ,function (){
    Route::get('address', 'MemberController@address');
    Route::get('collect', 'MemberController@collect');
    Route::get('id-valid', 'MemberController@idValid');
    Route::get('index', 'MemberController@index');
    Route::get('info', 'MemberController@info');
    Route::get('setting', 'MemberController@setting');
    Route::get('vip', 'MemberController@vip');
    Route::get('jingying-valid', 'MemberController@jingyingValid');
    Route::get('valid-index', 'MemberController@validIndex');

    //地址编辑
    Route::get('address-edit/{id}', 'MemberController@addressEdit');
    Route::get('address-add', 'MemberController@addressAdd');
    Route::post('address-del/{id}', 'MemberController@addressDel');
    Route::post('address-create/{id}', 'MemberController@addressCreate');
    Route::post('address-save/{id}', 'MemberController@addressCreate');





});

Route::get('test',function(){
    $obj = Supply::with('supplyAttrs');
    if(1){
        $obj = $obj->where('id','>',2);
    }
    if(1){
        $obj = $obj->get();
    }
    dd($obj);


});

//获取数据异步接口
Route::group(['namespace'=>'api' ,'prefix'=>'api'] ,function (){
    Route::get('kinds' , 'DataController@getKinds');
    Route::get('attribute' , 'DataController@getAttribute');
    Route::get('city' , 'DataController@getCity');
    Route::get('get-want-list' , 'DataController@getMemberWantList');
    Route::get('want-list' , 'DataController@getWantList');
    Route::get('quote-all' , 'DataController@getQuote');
    Route::get('supply-all' , 'DataController@getSupplyAll');
    Route::get('sub-city' , 'DataController@getSubCity');

});


//处理上传图片
Route::post('/uploadfile' , 'User\UserSettingController@uploadfile');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
