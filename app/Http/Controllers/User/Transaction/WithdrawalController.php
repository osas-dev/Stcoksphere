<?php

namespace App\Http\Controllers\User\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class WithdrawalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //all withdrawls page
        $withdrawals = auth()->user()->withdrawal()->latest()->paginate(10);


        return view('user.transactions.withdrawals.withdrawals', compact('withdrawals'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function method()
    {
        //add withdrawals page
        return view('user.transactions.withdrawals.method');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $user = auth()->user();

        //bank withdrawal

        if ($request->method === 'bank') {
            $data = [
                'full_name' => $request->full_name,
                'bank_name' => $request->bank_name,
                'account_number' => $request->account_number,
                'bank_branch' => $request->bank_branch,
                'routing_number' => $request->routing_number,
                'swift_code' => $request->swift_code,
            ];
            $user->withdrawal()->create([
                'txid' => generateTxId(),
                'method' => $request->method,
                'amount' => $request->amount,
                'status' => 'pending',
                'details' => json_encode($data),
            ]);

            Alert::success('Withdraw Success', 'Your money will be sent to the bank account you submited',);
            return redirect()->route('user.transactions.withdrawals');
        } else {

            //crypto withdrawal
            $data = [
                'crypto_address' => $request->crypto_address,
                'crypto_network' => $request->crypto_network,
            ];
            $user->withdrawal()->create([
                'txid' => generateTxId(),
                'method' => $request->method,
                'amount' => $request->amount,
                'status' => 'pending',
                'details' => json_encode($data),
            ]);

            Alert::success('Withdraw Success', 'Your money will be sent to the crypto address you submited',);
            return redirect()->route('user.transactions.withdrawals');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        //
        $request->validate([
            'method' => 'required|string',
            'amount' => 'required|numeric|min:1',
        ]);

        $method = $request->method;
        $amount = $request->amount;
        if ($method === 'bank') {
            return view('user.transactions.withdrawals.methods.bank', compact('amount'));
        } else {
            return view('user.transactions.withdrawals.methods.crypto', compact('amount'));
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Withdrawal $withdrawal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Withdrawal $withdrawal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Withdrawal $withdrawal)
    {
        //
    }
}
