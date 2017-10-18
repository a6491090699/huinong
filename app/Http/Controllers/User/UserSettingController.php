<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserSettingController extends Controller
{
    //


    public function uploadfile(Request $request)
    {
        //要让文件能被访问到 php artisan storage:link 然后 huinong.app/storage/hehe.png
        $filepath = date('Y/m/d');

        $path = $request->file('avatar')->store('public/'.$filepath);
        // /public/2017/10/18/J9bL2J8TQmuvLhRdYVhZxDcfYivv9cNEojANs1zY.png
        // return str_replace('public','storage', $path);
        return $path;
        
    }
}
