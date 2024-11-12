<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Stocks;
use App\Models\TradeHistory;
use File;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use View;

class StocksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.stocks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->hasFile('img')) {
            $img = $request->file('img')->store('/admin/stock/img');
        } else {
        
            Alert::error('An Image is required for a stock to be created');
            return back()->withErrors(['img' => 'An Image is required for a stock to be created.']);

        }
        //create a stock
        Stocks::create([
            'name' => $request->name,
            'unit' => $request->unit,
            'price' => $request->price,
            'market_capital' => $request->market_capital,
            'daily_change' => $request->daily_change,
            'weekly_change' => $request->weekly_change,
            'status' => $request->status,
            'img' => $img
        ]);

        Alert::success('Stock has been created');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $stocks = Stocks::all();
        return view('admin.stocks.stocks', compact('stocks'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stocks $stock)
    {
        return view('admin.stocks.edit', ['stock' => $stock]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stocks $stock)
    {
        if ($request->hasFile('img')) {
            File::delete(storage_path('app/public/' . $stock->img));
            $img = $request->file('img')->store('/admin/stock/img');
        } else {
            $img = $stock->img;

        }

        $stock->update([
            'name' => $request->name,
            'unit' => $request->unit,
            'price' => $request->price,
            'market_capital' => $request->market_capital,
            'daily_change' => $request->daily_change,
            'weekly_change' => $request->weekly_change,
            'status' => $request->status,
            'img' => $img
        ]);

        Alert::success('Stock has been updated');
        return redirect()->route('admin.stocks');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stocks $stock)
    {
        $stock->delete();

        Alert::success('Stock has been deleted');
        return redirect()->back();
    }
    public function history()
    {
        $transactions = TradeHistory::latest()->paginate(15);
        return view('admin.stocks.history', compact('transactions'));
    }
}
