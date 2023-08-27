<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    function page(Request $request){
        $seo = DB::table('seoproperties')->where('pageName','=','Projects ')->first();
        return view('pages.projects', ['seo'=>$seo]);
    }
    function projectData(Request $request){
        // sleep(20);
        return DB::table('projects')->get();
    }
}
