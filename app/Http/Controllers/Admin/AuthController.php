<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin')->only(['dashboard','logout']);
    }
        
    
    public function show_login() {

        if(Auth::guard('admin')->check()) {
            return redirect()->back();
        }else {
            return view('admin.auth.login');

        }
    }


 public function dashboard() {
     return view('admin.dashboard');

 }

    public function login(Request $request) {
        $email = $request->email;
        $password = $request->password;
        $data = ['email' => $email , 'password' => $password];
        if(Auth::guard('admin')->attempt($data)) {
            return view('admin.dashboard');
        }else {
            return redirect()->back();
        }
    }



    public function logout()
    {

        Auth::guard('admin')->logout();
        return redirect()->route('loginform');
    }

}
