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


Route::get('/', function () {
    // echo config('wechat.appid');exit;

    //
    // $data =\App\Model\Member::all();
    //
    //
    // dd($data);
    $wdata = Want::with('wantAttrs.attrs','kinds','quotes')->limit(6)->get();
    return view('home.index' , ['wdata'=>$wdata]);
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



});


//获取数据异步接口
Route::group(['namespace'=>'api' ,'prefix'=>'api'] ,function (){
    Route::get('kinds' , 'DataController@getKinds');
    Route::get('guige' , 'DataController@getGuige');
    Route::get('city' , 'DataController@getCity');
    Route::get('get-want-list' , 'DataController@getMemberWantList');
    Route::get('want-list' , 'DataController@getWantList');
    Route::get('quote-all' , 'DataController@getQuote');
    Route::get('supply-all' , 'DataController@getSupplyAll');

});


//处理上传图片
Route::post('/uploadfile' , 'User\UserSettingController@uploadfile');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
