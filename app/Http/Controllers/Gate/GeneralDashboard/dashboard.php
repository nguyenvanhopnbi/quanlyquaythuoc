<?php

namespace App\Http\Controllers\Gate\GeneralDashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class dashboard extends Controller
{
    public function index(){
        return view('gate.GeneralDashboard.dashboard');
    }
}
