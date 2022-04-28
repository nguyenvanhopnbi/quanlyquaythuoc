<?php

namespace App\Http\Controllers\Gate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BankTransactionLivewireController extends Controller
{
    public function index(){
        return view('gate.bank-transaction.list-transaction-livewire');
    }
}
