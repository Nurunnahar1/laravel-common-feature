<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerStoreRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    function registerPage(){
        return view('frontend.pages.auth.register');
    }
    function registerStore(CustomerStoreRequest $request){

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' =>Hash::make($request->password) ,
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        //login attempt if success then redirect home
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->route('');
        }
    }


    function loginPage(){
        return view('frontend.pages.auth.login');
    }

    function loginStore(Request $request){
        $validated = $request->validate([
            'email'=>'required|email',
            'password'=>'required|string|min:4',
        ]);

        $credentials = [
            'email' => $request->email,
            'password'=>$request->password
        ];

        if(Auth::attempt($credentials,$request->filled('remember'))){
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');  //return redirect()->intended('admin/dashboard');  same
        }

        return back()->withErrors([
           'email' => 'Wrong Credentials found'
        ])->only('email');
    }


    function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login.page');
    }

}
