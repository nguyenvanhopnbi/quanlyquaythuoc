<?php

namespace App\Http\Controllers\Gate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Paypal extends Controller
{
    public function index(){
        return view('gate.paypal.list');
    }
}
