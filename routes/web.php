<?php

use App\Http\Controllers\Admin\FinancesController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserDepositController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\InvestmentController;
use App\Http\Controllers\LotteryController;
use App\Http\Controllers\RefererController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\WithdrawController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('deposits', DepositController::class)->only(['index', 'store']);
    Route::resource('/wallet', WalletController::class)->only(['index', 'store']);
    Route::resource('/withdraws', WithdrawController::class)->only(['index', 'store']);
    Route::resource('/investments', InvestmentController::class);

    Route::get('lottery/info', [LotteryController::class, 'info'])->name('lottery.info');
    Route::resource('lottery', LotteryController::class);

    Route::inertia('/history', 'History/Index')->name('history');
    Route::inertia('/settings', 'Setting/Index')->name('settings');

    Route::get('/referers', [RefererController::class, 'index'])->name('referers.index');

    Route::middleware('role:admin')
        ->name('admin.')
        ->group(function () {
            Route::post('users/{user}/role', [UsersController::class, 'toggleRole'])->name('users.role.toggle');
            Route::resource('users', UsersController::class);
            Route::resource('users.deposits', UserDepositController::class)->shallow()->only(['index', 'store', 'destroy']);
            Route::resource('payments', PaymentController::class);
            Route::resource('system/settings', SettingController::class);

            Route::get('finances', FinancesController::class)->name('finances.index');
        });
});
