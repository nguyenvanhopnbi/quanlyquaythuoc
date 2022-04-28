<?php

namespace App\Http\Controllers\Gate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PartnerPaymentMethod extends Controller
{
    public function index(){
        return view('partner-payment-method.list');
    }
}
