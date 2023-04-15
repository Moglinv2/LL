<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Http;

class DepositController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Inertia::render('Deposit/Index', [
            'deposit_wallet' => $request->session()->get('wallet'),
        ]);
    }

    public function store(Request $request)
    {
        $validation = $request->validate([
            'currency' => ['required', Rule::in(['btc', 'usdt'])]
        ]);

        $currency = ($validation['currency'] == 'usdt') ? 'trc20/usdt' : $validation['currency'];

        $ca = Http::get("https://api.blockbee.io/$currency/create/", [
            'apikey' => env('CRYPTAPI_TOKEN'),
            'callback' => route('webhook.cryptapi', ['user' => $request->user(), 'date' => Carbon::today()->toDateString()])
        ])->json();

        return back()->with('wallet', [
            'currency' => $validation['currency'],
            'address' => $ca['address_in']
        ])->banner('Address Generate Successfull');
    }
}
