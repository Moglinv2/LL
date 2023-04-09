<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class WalletController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Wallet/Index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'withdraw_address' => 'required|string'
        ]);

        $request->user()->update($validated);
        return back()->banner('Wallet Update!');
    }
}
