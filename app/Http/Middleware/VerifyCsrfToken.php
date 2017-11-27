<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
        '/wx/jsapi',
        '/wx/index',
        '/wx/notify',   //默认的回调
        '/wx/want-notify',  //发布求购
        '/wx/supply-notify', // 发布紧急商品
        '/wx/member-notify',
    ];
}
