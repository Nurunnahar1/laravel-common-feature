<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    function adminDashboard(){
        return view('admin.index');
    }
}
