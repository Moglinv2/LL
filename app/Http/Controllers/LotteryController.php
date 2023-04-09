<?php

namespace App\Http\Controllers;

use App\Models\LotteryNumber;
use App\Models\LotteryTicket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LotteryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        return Inertia::render('Lottery/Index', [
            'active_tickets' => $request->user()->ActiveLotteryTickets()->get(),
            'ticket_price' => intval(config('system.ticket_price', 25))
        ]);
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
            'numbers' => ['required', 'array']
        ]);

        if (intval(config('system.ticket_price', 25)) > $request->user()->balance) {
            return back()->dangerBanner('Insufficient Balance');
        }

        $request->user()->LotteryTickets()->create([
            'price' => intval(config('system.ticket_price', 25)),
            'expired_at' => Carbon::now()->next(Carbon::TUESDAY),
            'numbers' => $validated['numbers'],
        ]);

        $request->user()->fixBalance();
        return back()->banner('Lottery Ticket Purchased');
    }

    public function info()
    {
        return response()->json([
            'last_numbers' => LotteryNumber::orderBy('id', 'desc')->take(2)->get(),
            'next_number' => Carbon::today()->next(Carbon::TUESDAY)->toDateTimeString()
        ]);
    }
}
