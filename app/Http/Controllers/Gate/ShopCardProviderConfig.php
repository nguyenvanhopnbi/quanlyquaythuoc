<?php

namespace App\Http\Controllers\Gate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShopCardProviderConfig extends Controller
{
    public function index(){
        return view('gate.shop-card-provider-config.list');
    }
}
