<?php

namespace App\Http\Controllers\Admin\Transaction;

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
        //
        $withdrawals = Withdrawal::latest()->paginate(15);

        return view('admin.withdrawals.index', compact('withdrawals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Withdrawal $withdrawal)
    {
        //
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
    public function approve(Withdrawal $withdrawal)
    {
        //update user balance
        $user = $withdrawal->user;
        $user->main_balance += $withdrawal->amount;
        $user->save();

        // update withdrawal status
        $withdrawal->update([
            'status' => 'completed',
            'reason' => 'Cleared'
        ]);

        Alert::success('Withdrawal has been approved');
        return redirect()->back();
    }
    public function reject(Withdrawal $withdrawal)
    {
        // update withdrawal status
        $withdrawal->update([
            'status' => 'rejected',
            'reason' => 'Failed'
        ]);

        Alert::success('Withdrawal has been rejected');
        return redirect()->back();
    }
    public function pending_withdrawals() {
        $withdrawals = Withdrawal::where('status', 'pending')->latest()->paginate(15);
        return view('admin.withdrawals.pending', compact('withdrawals'));
    }
    public function completed_withdrawals() {
        $withdrawals = Withdrawal::where('status', 'completed')->latest()->paginate(15);
        return view('admin.withdrawals.completed', compact('withdrawals'));
    }
    public function rejected_withdrawals() {
        $withdrawals = Withdrawal::where('status', 'rejected')->latest()->paginate(15);
        return view('admin.withdrawals.rejected', compact('withdrawals'));
    }
}
