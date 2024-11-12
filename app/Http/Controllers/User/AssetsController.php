<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Assets;
use App\Models\Stocks;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AssetsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //show assets
        $assets = auth()->user()->assets()->with('stock')->get();
        return view('user.assets', compact('assets'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //buy or sell a stock
        $request->validate([
            'stock' => 'required',
            'tradeType' => 'required|in:buy,sell',
            'amount' => 'required|numeric|min:1',
        ]);

        $user = auth()->user();
        $stockName = $request->stock;
        $tradeType = $request->tradeType;
        $amount = $request->amount;

        // Retrieve stock from database
        $stock = Stocks::where('name', $stockName)->first();
        if (!$stock) {
            return back()->withErrors(['stock' => 'Invalid stock selected.']);
        }

        // Buy logic: add asset to user's holdings
        $asset = $user->assets()->where('stock_id', $stock->id)->first();


        if ($tradeType === 'buy') {
            // Check if user has enough balance
            if ($user->main_balance < $amount) {
                Alert::error('Error', 'Insufficient balance for this purchase');
                return back();
            }

            // Deduct the total cost from user's balance
            $user->main_balance -= $amount;

            if ($asset) {
                // If user already has the stock, increase the quantity
                $asset->quantity += $amount;
                $asset->save();
            } else {
                // Otherwise, create a new asset record
                $user->assets()->create([
                    'stock_id' => $stock->id,
                    'quantity' => $amount,
                ]);
            }
            $user->tradeHistory()->create([
                'stock_id' => $stock->id,
                'tradeType' => 'buy',
                'txid' => generateTxId(),
                'amount' => $amount
            ]);
            Alert::success('Success', 'You currently bought $'. $amount . ' of '. $stock->name);

        } elseif ($tradeType === 'sell') {
            // Sell logic: check if user owns the stock
            $asset = $user->assets()->where('stock_id', $stock->id)->first();

            if (!$asset || $asset->quantity < $amount) {
                Alert::error('Failed', 'Insufficient stock quantity to sell.');
                return back();
            }
    
            // Calculate proceeds and update balance
            $user->main_balance += $amount;
    

            // Decrease or remove asset quantity
            $asset->quantity -= $amount;
            if ($asset->quantity == 0) {
                $asset->delete(); // Remove record if quantity is zero
            } else {
                $asset->save();
            }

            $user->tradeHistory()->create([
                'stock_id' => $stock->id,
                'tradeType' => 'sell',
                'txid' => generateTxId(),
                'amount' => $amount
            ]);
            Alert::success('Success', 'You currently sold $'. $amount . ' of '. $stock->name);
        }

        return redirect()->back();
    }


}
