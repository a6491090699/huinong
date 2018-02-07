<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    //
    use AuthenticatesUsers;


    protected $redirectTo = '/admin/index';

    public function __construct()
    {

        // dd($this->middleware('admin',['guard'=>'admin']));
        $this->middleware('guest:admin')->except('logout');


    }

    public function showLoginForm()
    {
        return view('admin.login');
    }

    protected function validateLogin(Request $request)
    {
        $this->validate($request , [
            'username' => 'required|string|min:6|max:16',
            'password' => 'required|string|min:6|max:16'

        ]);
    }
    protected function guard()
    {
        return auth()->guard('admin');
    }
    public function username()
    {
        return 'username';
    }


    public function logout(Request $request)
    {
        // dd($request->all());
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect('/admin/login');
    }

    // public function login(Request $request){
    //     dd($request->all());
    // }


}
