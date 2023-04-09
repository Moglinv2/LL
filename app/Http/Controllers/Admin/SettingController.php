<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Inertia::render('Admin/Setting/Index', [
            'settings' => Setting::get()->mapWithKeys(function ($item, $key) {
                return [$item['key'] => $item['value']];
            })
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
        $settings = collect($request->all())->reduce(function ($carry, $value, $key) {
            $carry[] = [
                'key' => $key,
                'value' => $value
            ];
            return $carry;
        }, []);

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                ['value' => $setting['value']],
            );
        }

        return back()->banner('Settings Updated');
    }
}
