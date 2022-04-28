<?php

namespace App\Http\Controllers\Gate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PartnerAppotaService extends Controller
{
    public function index(){
        return view('gate.Partner-Appota-Service.index');
    }
}
