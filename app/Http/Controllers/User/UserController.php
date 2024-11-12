<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\Stocks;
use App\Models\TradeHistory;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    //buy stock
    public function index()
    {
        //dashboard
        $total_deposits = Deposit::where('user_id', auth()->id())->where('status', 'completed')->sum('amount');
        $total_withdrawals = Withdrawal::where('user_id', auth()->id())->where('status', 'completed')->sum('amount');
        $user = auth()->user();
        $transactions = auth()->user()->tradeHistory()->with('stock')->latest()->paginate(10);
        return view('user.dashboard', compact('total_deposits', 'total_withdrawals', 'user', 'transactions'));
    }
    public function allStocks()
    {
        //view all stocks
        $stocks = Stocks::where('status', 'Active')->get();
        return view('user.stocks', compact('stocks'));
    }
    public function trade(Stocks $stock)
    {
        //show trade form
        $allStocks = Stocks::all();
        return view('user.trade', compact('allStocks', 'stock'));


    }
    public function create()
    {
        //
        $allStocks = Stocks::all();
        return view('user.newTrade', compact('allStocks'));

    }
    public function trade_history()
    {
        //
        $transactions = auth()->user()->tradeHistory()->with('stock')->latest()->paginate(10);

        return view('user.transactions.trade_history', compact('transactions'));
    }
    public function transfer()
    {
        // Internal transfer
        $user = auth()->user();
        $invest_balance = $user->invest_balance;

        if ($invest_balance > 0) {
            // Transfer profits to main balance
            $user->main_balance += $invest_balance;

            // Deduct invest balance (set to zero after transfer)
            $user->invest_balance = 0;

            // Save the user's updated balance
            $user->save();

            // Show success alert
            Alert::success('Transfer Successful', 'You have successfully transferred your profits to your main balance');
        } else {
            // Show an error alert if there's no balance to transfer
            Alert::error('Transfer Failed', 'No profits available for transfer');
        }

        return redirect()->back();
    }



}
