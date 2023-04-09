<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Admin/Payment/Index', [
            'payments' => Withdraw::whereHas('user')->with('user')->latest()->paginate(10)
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
    public function automate(Request $request, Withdraw $payment)
    {
        $validated = $request->validate([
            'password'  => 'required|string'
        ]);

        $payment_password = config('system.payment_password');
        if (!password_verify($validated['password'], $payment_password)) {
            return back()->dangerBanner('Password Wrong');
        }

        $payment = $payment->Pay($validated['password']);
        if ($payment) {
            return back()->banner("Payment Succesfull $payment");
        } else {
            return back()->dangerBanner('Something was wrong');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Withdraw $payment)
    {
        $validated = $request->validate([
            'status' => 'required|string',
            'reason' => 'nullable|string'
        ]);

        $payment->update($validated);

        return back()->banner('Payment Change Successfull');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
