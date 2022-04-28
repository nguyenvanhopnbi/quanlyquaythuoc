<?php

namespace App\Http\Controllers\Gate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class qrCodeController extends Controller
{
    public function index(){
        return view('gate.QRCode.index');
    }
}
