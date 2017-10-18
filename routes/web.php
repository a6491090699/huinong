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
Route::get('/', function () {
    return view('welcome');
});

Route::get('uploadform' , function(){
    // echo asset('storage/hehe.png');exit;
    return view('upload');
});


//处理上传图片
Route::post('/uploadfile' , 'User\UserSettingController@uploadfile');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
