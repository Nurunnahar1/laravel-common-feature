<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    function DashboardPage():View{


        return view('pages.dashboard.dashboard-page');
    }

    // function DashboardPage(Request $userId): View {
    //     $user = User::find($userId);

    //     if ($user && $user->role == 1) {
    //         return view('pages.dashboard.dashboard-page');
    //     }

    //     return view('userLogin');
    // }
}
