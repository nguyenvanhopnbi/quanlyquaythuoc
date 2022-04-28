<?php

namespace App\Http\Controllers\Gate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class partnerBusiness extends Controller
{
    public function index(){
        return view('gate.partner-business.index');
    }
}
