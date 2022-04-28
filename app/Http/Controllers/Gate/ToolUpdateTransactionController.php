<?php

namespace App\Http\Controllers\Gate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ToolUpdateTransactionController extends Controller
{
    public function index(){
        return view('gate.tool.index');
    }
}
