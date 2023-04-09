<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Deposit;
use Illuminate\Support\Facades\Http;
class WebhookController extends Controller
{
    public function cryptapi(Request $request, User $user)
    {
        $validated = $request->validate([
            'txid_in'       => 'required|string',
            'value_coin'    => 'required|numeric',
            'coin'          => 'required|string'
        ]);

        if(Deposit::where('txId', $validated['txid_in'])->count()) {
            return response("*ok*", 200)->header('Content-Type', 'text/plain');
        }

        $conversion = Http::get("https://pro-api.cryptapi.io/usd/convert/", [
            'apikey' => env('CRYPTAPI_TOKEN'),
            'value'  => $validated['value_coin'],
            'from'   => $validated['coin']
        ] )->json();

        $user->MakeDeposit([
            'amount' => $conversion['value_coin'],
            'txId' => $validated['txid_in'],
            'data' => json_encode($request->input())
        ]);

        return response("*ok*", 200)->header('Content-Type', 'text/plain');
    }
}
