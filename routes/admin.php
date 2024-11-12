<?php

use App\Http\Controllers\Admin\InvestmentController;
use App\Http\Controllers\Admin\Transaction\DepositController;
use App\Http\Controllers\Admin\Transaction\WithdrawalController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\StocksController;


Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/',  [AdminController::class, 'dashboard' ])->name('admin');
    Route::get('dashboard',  [AdminController::class, 'dashboard' ])->name('admin.dashboard');
    Route::get('/profile', [AdminController::class, 'edit'])->name('admin.profile.edit');
    Route::patch('/profile', [AdminController::class, 'update'])->name('admin.profile.update');
    Route::delete('/profile', [AdminController::class, 'destroy'])->name('admin.profile.destroy');
    Route::put('password/update',  [AdminController::class, 'update_password' ])->name( 'admin.password.update');


    //admin stock routes
    Route::prefix('stocks')->group(function () {
        Route::get('',  [StocksController::class, 'show' ])->name( 'admin.stocks');
        Route::get('edit/{stock}',  [StocksController::class, 'edit' ])->name( 'admin.stocks.edit');
        Route::get('create',  [StocksController::class, 'create' ])->name( 'admin.stocks.create');
        Route::post('store',  [StocksController::class, 'store' ])->name( 'admin.stocks.store');
        Route::put('update/{stock}',  [StocksController::class, 'update' ])->name( 'admin.stocks.update');
        Route::delete('destroy/{stock}',  [StocksController::class, 'destroy' ])->name( 'admin.stocks.destroy');
        Route::get('history',  [StocksController::class, 'history' ])->name( 'admin.stocks.history');
    });
    Route::prefix('plans')->group(function () {
        Route::get('',  [InvestmentController::class, 'index' ])->name( 'admin.plans');
        Route::get('edit/{plan}',  [InvestmentController::class, 'edit' ])->name( 'admin.plans.edit');
        Route::get('create',  [InvestmentController::class, 'create' ])->name( 'admin.plans.create');
        Route::post('store',  [InvestmentController::class, 'store' ])->name( 'admin.plans.store');
        Route::put('update/{plan}',  [InvestmentController::class, 'update' ])->name( 'admin.plans.update');
        Route::delete('destroy/{plan}',  [InvestmentController::class, 'destroy' ])->name( 'admin.plans.destroy');
        Route::get('all',  [InvestmentController::class, 'all' ])->name( 'admin.plans.all');
        Route::get('active',  [InvestmentController::class, 'active_plans' ])->name( 'admin.plans.active');
        Route::get('completed',  [InvestmentController::class, 'completed_plans' ])->name( 'admin.plans.completed');
    });
    Route::prefix('user')->group(function () {
        Route::get('all',  [UserController::class, 'index' ])->name( 'admin.users');
        Route::get('{user}/edit',  [UserController::class, 'edit' ])->name( 'admin.user.edit');
        Route::delete('{user}/destroy',  [UserController::class, 'destroy' ])->name( 'admin.user.delete');
        Route::put('{user}/update',  [UserController::class, 'update' ])->name( 'admin.user.update');
        Route::put('{id}/password/update',  [UserController::class, 'update_password' ])->name( 'admin.user.password.update');
        Route::post('balance/add',  [UserController::class, 'add_balance' ])->name( 'admin.user.add_balance');
        Route::post('balance/subtract',  [UserController::class, 'subtract_balance' ])->name( 'admin.user.subtract_balance');
    });
    Route::prefix('deposit')->group(function () {
        Route::get('all',  [DepositController::class, 'index' ])->name( 'admin.deposits');
        Route::get('approve/{deposit}',  [DepositController::class, 'approve' ])->name( 'admin.deposits.approve');
        Route::get('reject/{deposit}',  [DepositController::class, 'reject' ])->name( 'admin.deposits.reject');
        Route::get('pending',  [DepositController::class, 'pending_deposits' ])->name( 'admin.deposits.pending');
        Route::get('completed',  [DepositController::class, 'completed_deposits' ])->name( 'admin.deposits.completed');
        Route::get('rejected',  [DepositController::class, 'rejected_deposits' ])->name( 'admin.deposits.rejected');

        Route::prefix('methods')->group(function () {
            Route::get('/',  [DepositController::class, 'methods' ])->name( 'admin.deposits.methods');
            Route::get('create',  [DepositController::class, 'create_method' ])->name( 'admin.deposits.method.create');
            Route::post('store',  [DepositController::class, 'store_method' ])->name( 'admin.deposits.method.store');
            Route::get('edit/{method}',  [DepositController::class, 'edit_method' ])->name( 'admin.deposits.method.edit');
            Route::put('update/{method}',  [DepositController::class, 'update_method' ])->name( 'admin.deposits.method.update');
            Route::delete('destroy/{method}',  [DepositController::class, 'destroy_method' ])->name( 'admin.deposits.method.destroy');

        });
    });
    Route::prefix('withdrawal')->group(function () {
        Route::get('all',  [WithdrawalController::class, 'index' ])->name( 'admin.withdrawals');
        Route::get('approve/{withdrawal}',  [WithdrawalController::class, 'approve' ])->name( 'admin.withdrawals.approve');
        Route::get('reject/{withdrawal}',  [WithdrawalController::class, 'reject' ])->name( 'admin.withdrawals.reject');
        Route::get('pending',  [WithdrawalController::class, 'pending_withdrawals' ])->name( 'admin.withdrawals.pending');
        Route::get('completed',  [WithdrawalController::class, 'completed_withdrawals' ])->name( 'admin.withdrawals.completed');
        Route::get('rejected',  [WithdrawalController::class, 'rejected_withdrawals' ])->name( 'admin.withdrawals.rejected');
    });
});
