<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FinancesController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Admin/Finance/Index', [
            'total_crypto_deposits' => Deposit::where('txId', '!=', '000')->sum('amount'),
            'total_manual_deposits' => Deposit::where('txId', '000')->sum('amount'),
            'total_paid' => Withdraw::sum('amount'),
            'total_funds' => Deposit::sum('amount') - Withdraw::sum('amount'),
        ]);
    }
}
