<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AgentController extends Controller
{
    function agentDashboard(){
        return view('agent.agent_dashboard');
    }
}
