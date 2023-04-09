<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class RefererController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Referer/Index', [
            'reward_points' => $request->user()->RefererProfits()->sum('amount') / 2,
            'referers_count' => $request->user()->referers_count,
        ]);
    }
}
