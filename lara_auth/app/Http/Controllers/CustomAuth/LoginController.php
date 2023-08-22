<?php

namespace App\Http\Controllers\CustomAuth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    function loginFormShow(){
        return view('custom-auth.lorin');
    }
    function loginUser(Request $request){
        // dd($request->all());
        $request->validate([
            'password' =>'bail|required|string' ,
            'email'=>'bail|required|string|email|max:255|exists:users,email',

               ]);



        //make a credential array
        $credentials=[
            'email' =>$request->email,
            'password' =>$request->password,
        ];
        //login attempt if successful then redirect home
        if(Auth::attempt($credentials,$request->filled('rememberme'))){
            $request->session()->regenerate();
            return redirect()->intended('home');
        }
        //return error message
        return back()->withErrors([
            'email'=>'Wrong credentials!!!'
        ])->onlyInput('email');

    }
    function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');

    }
}
