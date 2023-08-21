<?php

namespace App\Http\Controllers\CustomAuth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    function registerFormShow(){
        return view('custom-auth.register');
    }

    function registerUser(Request $request){

        //user validations

        $request->validate([
            'name' =>'bail|required|string|max:255' ,
            'email'=>'bail|required|string|email|max:255|unique:users',
            'phone' =>'bail|required|string',
            'password'=>['bail','required','string','confirmed',Password::min(4)->mixedCase()]
               ]);

//user creation
        User::create([
            'name' =>$request->name,
            'email' =>$request->email,
            'password' =>Hash::make($request->password),
            'phone'=>$request->phone
        ]);
        //make a credential array
        $credentials=[
            'email' =>$request->email,
            'password' =>$request->password,
        ];
        //login attempt if successful then redirect home
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended('home');
        }
        //return error message
        return back()->withErrors([
            'email'=>'Wrong credentials!!!'
        ])->onlyInput('email');
    }

    function logout(){
        
    }



}
