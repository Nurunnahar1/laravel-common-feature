<?php

namespace App\Http\Controllers\Demo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DemoController extends Controller
{
    function index(){
        return view('about');
    }
    function contactMethod(){
        return view('contact');
    }
}
