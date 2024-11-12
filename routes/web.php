<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\AssetsController;
use App\Http\Controllers\User\Transaction\DepositController;
use App\Http\Controllers\User\Transaction\WithdrawalController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\InvestmentController;
use App\Models\InvestmentPlan;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $plans = InvestmentPlan::where('status', 'Active')->get();
    return view('welcome', compact('plans'));
});


Route::middleware('auth')->prefix('user')->group(function () {
    Route::get('/', [UserController::class, 'index']);
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/stocks', [UserController::class, 'allStocks'])->name('user.stocks');
    Route::get('/trade/{stock}', [UserController::class, 'trade'])->name('user.trade');
    Route::get('/create/trade', [UserController::class, 'create'])->name('user.trade.create');
    Route::post('/trade-stock', [AssetsController::class, 'store'])->name('user.tradeStock');
    Route::get('/assets', [AssetsController::class, 'index'])->name('user.assets');
    Route::get('/plans', [InvestmentController::class, 'plans'])->name('user.plans');
    Route::post('/invest', [InvestmentController::class, 'invest'])->name('user.invest');
    Route::get('/transfer', [UserController::class, 'transfer'])->name('user.transfer');
    Route::get('/investments', [InvestmentController::class, 'investments'])->name('user.investments');

    //user transaction routes
    Route::prefix('transaction')->group(function () {
        Route::get('/trade_history', [UserController::class, 'trade_history'])->name('user.transactions.trade_history');
        Route::get('/deposits', [DepositController::class, 'index'])->name('user.transactions.deposits');
        Route::get('/withdrawals', [WithdrawalController::class, 'index'])->name('user.transactions.withdrawals');
        Route::get('/deposits/fund', [DepositController::class, 'create'])->name('user.transactions.deposits.method');
        Route::post('/deposits/method', [DepositController::class, 'show'])->name('user.transactions.deposits.method.show');
        Route::post('/deposits/add', [DepositController::class, 'store'])->name('user.transactions.add_deposits');
        Route::post('/withdrawals/add', [WithdrawalController::class, 'store'])->name('user.transactions.add_withdrawals');
        Route::get('/withdrawals/method', [WithdrawalController::class, 'method'])->name('user.transactions.withdrawals.methods');
        Route::post('/withdrawals/method/show', [WithdrawalController::class, 'show'])->name('user.transactions.withdrawals.methods.show');
    });
});

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
