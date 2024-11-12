<?php

namespace App\Http\Controllers\User\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\DepositMethod;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class DepositController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //view all deposits
        $deposits = auth()->user()->deposit()->latest()->paginate(10);
        

        return view('user.transactions.deposits.deposits', compact('deposits'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // add deposit page
        $methods = DepositMethod::all();
        return view('user.transactions.deposits.method', compact('methods'));
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'method' => 'required|string',
            'amount' => 'required|numeric|min:1',
        ]);
        if ($request->hasFile('img')) {
            $img = $request->file('img')->store('/admin/stock/img');
        } else {
            Alert::error('Failed', 'Your proof of payment is required');
            return back();

        }
        //create a deposit transaction
        $user = auth()->user();

        $user->deposit()->create([
            'txid' => generateTxId(),
            'method' => $request->method,
            'amount' => $request->amount,
            'status' => 'pending',
            'proof' => $img
        ]);

        Alert::success('Deposit Success', 'Deposit was successful kindly wait for it to be confirmed');
        return redirect()->route('user.transactions.deposits.method');
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

        $method_name = $request->method;
        $amount = $request->amount;
        $method = DepositMethod::where('name',$method_name)->firstOrFail();

        return view('user.transactions.deposits.add', compact('method', 'amount'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Deposit $deposit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Deposit $deposit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Deposit $deposit)
    {
        //
    }
}
