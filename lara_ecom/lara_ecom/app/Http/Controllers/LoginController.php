<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    function loginPage(){
        return view('backend.pages.auth.login');
    }

    function login(Request $request){
        $validated = $request->validate([
            'email'=>'required|email',
            'password'=>'required|string|min:4',
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if(Auth::attempt($credentials,$request->filled('remember'))){
            $request->session()->regenerate();
            return redirect()->intended('admin.dashboard');
        }
        return back()->withErrors([
            'email'=>'wrong password or email'
        ])->onlyInput('email');
    }
}
