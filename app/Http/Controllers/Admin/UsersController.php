<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $name = $request->input('name');
        return Inertia::render('Admin/User/Index', [
            'users' => User::where('role', '!=', 'admin')->Name($name)->withSum('deposits', 'amount')->withSum(['withdraws' => function ($query) {
                return $query->where('status', 'paid');
            }], 'amount')->orderBy('id')->latest()->paginate(10)
        ]);
    }

    public function toggleRole(User $user)
    {
        $user->role = ($user->role == 'user') ? 'reseller' : 'user';
        $user->save();

        return back()->banner('Role toggle succesfully!');
    }
}
