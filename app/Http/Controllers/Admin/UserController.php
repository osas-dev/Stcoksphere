<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users = User::latest()->paginate(15);
        return view('admin.user.index', compact('users'));
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
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
        return view('admin.user.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //update user information
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        Alert::success('User updated successfully');
        return redirect()->back();

    }
    public function update_password(Request $request, $id)
    {
        // Validate the new password
        $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);

        // Find the user
        $user = User::findOrFail($id);

        // Update the user's password
        $user->password = Hash::make($request->password);
        $user->save();

        Alert::success('Password updated successfully');

        return redirect()->back()->with('status', 'Password updated successfully.');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
        $user->delete();
        Alert::success('User deleted successfully');
        return redirect()->route('admin.users');
    }
    public function add_balance(Request $request)
    {
        //add balance
        $user = User::findOrFail($request->user_id);

        if (!$user) {
            return redirect()->back()->withErrors(['user_id' => 'User not found.']);
        }

        // Create the deposit record for the user
        $user->deposit()->create([
            'txid' => 'TXN' . generateTxId(), // Generate transaction ID
            'amount' => $request->amount,
            'status' => 'completed',
            'method' => 'Admin',
            'reason' => $request->reason,
        ]);

        // Optionally update the user's balance (if needed)
        $user->main_balance += $request->amount;
        $user->save();

        Alert::success('Deposit successful for User: ' . $user->name);

        return redirect()->back()->with('status', 'Deposit successful for User ID: ' . $user->id);
    
    }
    public function subtract_balance(Request $request)
    {
        //subtract balance
        $user = User::find($request->user_id);

        if (!$user) {
            return redirect()->back()->withErrors(['user_id' => 'User not found.']);
        }

        // Create the deposit record for the user
        $user->withdrawal()->create([
            'txid' => 'TXN' . generateTxId(), // Generate transaction ID
            'amount' => $request->amount,
            'status' => 'completed',
            'method' => 'Admin',
            'reason' => $request->reason,
        ]);

        // Optionally update the user's balance (if needed)
        $user->main_balance -= $request->amount;
        $user->save();

        Alert::success('Withdrawal successful for User: ' . $user->name);
        return redirect()->back()->with('status', 'Withdrawal successful for User ID: ' . $user->id);
    
    }
}
