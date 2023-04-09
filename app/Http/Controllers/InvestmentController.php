<?php

namespace App\Http\Controllers;

use App\Models\Investment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class InvestmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();
        // dd($user->rocket_price);
        // dd($user->is_rocket_active);

        return Inertia::render('Investment/Index', [
            'is_rocket_active' => $user->is_rocket_active,
            'rocket_price' => $user->rocket_price,
            'investments' => $user->Investments()->latest()->take(4)->get(),
            'settings' => [
                'plan_duration' => config('system.plan_duration'),
                'plan_profit' => config('system.plan_profit'),
                'boost_profit' => config('system.boost_profit'),
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'amount' => 'required|numeric',
            'plan' => 'required|string'
        ]);

        if ($validated['plan'] == 'rocket' && $request->user()->is_rocket_active) {
            return back()->dangerBanner('Something was wrong!');
        }

        if ($validated['plan'] == 'rocket') {
            if($request->user()->rocket_price <= 0) {
                return back()->dangerBanner('Something was wrong!');
            }

            $validated['amount'] = $request->user()->rocket_price;
        }

        if ($validated['amount'] > $request->user()->balance) {
            return back()->dangerBanner('Insufficient Balance');
        }

        $validated['expired_at'] = Carbon::now()->addDays(intval(config('system.plan_duration', 200)));
        $request->user()->Investments()->create($validated);
        $request->user()->fixBalance();

        return back()->banner('Investment Succesfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Investment  $investment
     * @return \Illuminate\Http\Response
     */
    public function show(Investment $investment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Investment  $investment
     * @return \Illuminate\Http\Response
     */
    public function edit(Investment $investment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Investment  $investment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Investment $investment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Investment  $investment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Investment $investment)
    {
        //
    }
}
