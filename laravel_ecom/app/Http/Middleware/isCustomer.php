<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\RedirectResponse;

class isCustomer
{    protected $auth;
    protected $route;

    function __construct(Guard $auth,Route $route){
        $this->auth = $auth;
        $this->route = $route;
    }



    public function handle(Request $request, Closure $next): Response
    {
        if($this->auth->user()->is_system_admin==1){
            return new Response('<h1 style="margin-top: 150px; color:dimgray"><center>401<br>Access Denied</center></h1>',401);
        }

        return $next($request);


        // if ($this->auth->user()->is_system_admin != 1) {
        //     // Redirect the user to a different page
        //     return redirect()->route('login.page')->with('error', 'Access Denied');
        // }

        // return $next($request);
    }
}
