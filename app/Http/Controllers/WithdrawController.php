<?php

namespace App\Http\Controllers;

use App\Models\Withdraw;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WithdrawController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Withdraw/Index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric'
        ]);

        if ($validated['amount'] > $request->user()->profit) {
            return back()->dangerBanner('Insufficient Profit');
        }

        if ($validated['amount'] < (float) config('system.min_withdraw_amount', 200)) {
            return back()->dangerBanner('Amount must be grether than ' . config('system.min_withdraw_amount', 200));
        }

        $validated['fee'] = ($validated['amount'] * (float) config('system.withdraw_fee', 2)) / 100;
        $request->user()->Withdraws()->create($validated);
        $request->user()->fixProfit();
        return back()->banner('Withdraw Succesfully');
    }
}
