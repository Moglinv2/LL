<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\LotteryNumber;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        return Inertia::render('Dashboard', [
            'last_deposit' => $user->Deposits()->orderBy('id', 'desc')->first(),
            'last_withdraw' => $user->Withdraws()->orderBy('id', 'desc')->first(),
            'stats' => [
                'staked' => Deposit::sum('amount'),
                'lottery' => LotteryNumber::Accumulated(),
                'arbol' => Deposit::count()
            ],
            'reward_points' => $user->RefererProfits()->sum('amount') / 2,
            'referers_count' => $user->referers_count
        ]);
    }
}
