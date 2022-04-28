<?php

namespace App\Http\Controllers\Gate\Lottery;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class lottery extends Controller
{

    public function index(){
        return view('gate.Lottery.lottery');
    }
    public function listProvider(){
        return view('gate.Lottery.provider');
    }

    public function listLotteryWin(){
        return view('gate.Lottery.listLotterywin');
    }
}
