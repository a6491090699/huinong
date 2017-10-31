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


//多维数组
function up($array , $pid=0){

    //二维数组
    foreach($array as $key=>$val){

        $id = $val['id'];
        $name = $val['name'];
        $model =new \App\Model\Kind;
        $model->id = $id;
        $model->pid = $pid;
        $model->name = $name;
        $model->save();

        if(isset($val['child']) && null!==$val['child']) up($val['child'],$val['id']);

    }


}


Route::get('/', function () {
    // echo config('wechat.appid');exit;


    $data =\App\Model\Member::all();


    dd($data);
    return view('home.index');
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

});


//获取数据异步接口
Route::group(['namespace'=>'api' ,'prefix'=>'api'] ,function (){
    Route::get('kinds' , 'DataController@getKinds');

});


//处理上传图片
Route::post('/uploadfile' , 'User\UserSettingController@uploadfile');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
