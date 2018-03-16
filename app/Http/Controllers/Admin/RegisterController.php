<?php

namespace App\Http\Controllers\Admin;

use App\Model\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/admin/admins';

    // public function __construct()
    // {
    //     // $this->middleware('');
    // }

    public function __construct()
    {
        // $this->middleware('guest:admin');
    }

    //

    public function guard()
    {
        return Auth::guard('admin');
    }

    public function registerPage()
    {
        return view('admin.register');
    }

    // public function register(Request $request)
    // {
    //     dd($request->all());
    //
    // }

    public function validator(array $data)
    {
        return Validator::make($data , [
            'username' => 'required|string|min:6|max:16',
            'password' => 'required|string|min:6|max:16'
        ]);
    }
    public function create(array $data)
    {
        return Admin::create([
            'username'=>$data['username'],
            'password'=>bcrypt($data['password']),
            'role_id'=>$data['role'],
        ]);
    }

}
