<?php

namespace App\Http\Controllers\CustomAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    function registerFormShow(){
        return view('custom-auth.register');
    }

    function registerUser(Request $request){
        dd($request->all());
    }
}
