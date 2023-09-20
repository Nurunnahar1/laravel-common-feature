<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Route;

class isSystemAdmin
{
    protected $auth;
    protected $route;

    function __construct(Guard $auth,Route $route){
        $this->auth = $auth;
        $this->route = $route;
    }



    public function handle(Request $request, Closure $next): Response
    {
        // dd($this->auth->user()->is_system_admin);
        if($this->auth->user()->is_system_admin!=1){
            return new Response('<h1 style="margin-top: 150px; color:dimgray"><center>401<br>Access Denied</center></h1>',401);
        }

        return $next($request);
    }
}
