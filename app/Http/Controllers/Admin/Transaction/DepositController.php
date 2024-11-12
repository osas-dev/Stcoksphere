<?php

namespace App\Http\Controllers\Admin\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\DepositMethod;
use File;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class DepositController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $deposits = Deposit::latest()->paginate(15);

        return view('admin.deposits.index', compact('deposits'));
    }
    public function methods()
    {
        //
        $methods = DepositMethod::latest()->paginate(15);

        return view('admin.deposits.method.index', compact('methods'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create_method()
    {
        //
        return view('admin.deposits.method.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store_method(Request $request)
    {
        //store the method in database
        {
            if ($request->hasFile('img')) {
                $img = $request->file('img')->store('/admin/methods/img');
            } else {
                Alert::error('An Image is required for a deposit method to be created');
                return back();

            }
            //create a deposit method
            DepositMethod::create([
                'name' => $request->name,
                'desc' => $request->desc,
                'status' => $request->status,
                'img' => $img
            ]);

            Alert::success('Deposit method has been created');
            return redirect()->back();
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit_method(DepositMethod $method)
    {
        //go to edit deposit method page
        return view('admin.deposits.method.edit', ['deposit' => $method]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update_method(Request $request, DepositMethod $method)
    {
        //update deposit method
        if ($request->hasFile('img')) {
            File::delete(storage_path('app/public/' . $method->img));
            $img = $request->file('img')->store('/admin/method/img');
        } else {
            $img = $method->img;

        }

        $method->update([
            'name' => $request->name,
            'desc' => $request->desc,
            'status' => $request->status,
            'img' => $img
        ]);

        Alert::success('Deposit method has been updated');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy_method(DepositMethod $method)
    {
        //delete deposit method
        $method->delete();
        Alert::success('Deposit method has been deleted');
        return redirect()->back();
    }
    public function approve(Deposit $deposit)
    {
        //update user balance
        $user = $deposit->user;
        $user->main_balance += $deposit->amount;
        $user->save();

        // update deposit status
        $deposit->update([
            'status' => 'completed',
            'reason' => 'Confirmed'
        ]);

        Alert::success('Deposit has been approved');
        return redirect()->back();
    }
    public function reject(Deposit $deposit)
    {
        // update deposit status
        $deposit->update([
            'status' => 'rejected',
            'reason' => 'Failed',
        ]);

        Alert::success('Deposit has been rejected');
        return redirect()->back();
    }
    public function pending_deposits()
    {
        $deposits = Deposit::where('status', 'pending')->latest()->paginate(15);
        return view('admin.deposits.pending', compact('deposits'));
    }
    public function completed_deposits()
    {
        $deposits = Deposit::where('status', 'completed')->latest()->paginate(15);
        return view('admin.deposits.completed', compact('deposits'));
    }
    public function rejected_deposits()
    {
        $deposits = Deposit::where('status', 'rejected')->latest()->paginate(15);
        return view('admin.deposits.rejected', compact('deposits'));
    }
}
