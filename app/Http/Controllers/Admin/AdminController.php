<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Deposit;
use App\Models\User;
use App\Models\UserInvestment;
use App\Models\Withdrawal;
use Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
  public function dashboard()
  {
    $total_deposits = Deposit::where('status', 'completed')->sum('amount');
    $total_withdrawals = Withdrawal::where('status', 'completed')->sum('amount');
    $total_users = User::count();
    $total_investments = UserInvestment::sum('amount');
    $users = User::latest()->paginate(15);
    return view('admin.dashboard', compact('users', 'total_investments', 'total_deposits', 'total_withdrawals', 'total_users'));
  }
  public function edit(Request $request)
  {
    return view('admin.profile.edit', [
      'user' => $request->user(),
    ]);
  }

  /**
   * Update the user's profile information.
   */
  public function update(ProfileUpdateRequest $request): RedirectResponse
  {
    $request->user()->fill($request->validated());

    if ($request->user()->isDirty('email')) {
      $request->user()->email_verified_at = null;
    }

    $request->user()->save();

    Alert::success('Profile updated successfully');
    return redirect()->route('profile.edit');
  }

  /**
   * Delete the user's account.
   */
  public function destroy(Request $request): RedirectResponse
  {
    $request->validateWithBag('userDeletion', [
      'password' => ['required', 'current_password'],
    ]);

    $user = $request->user();

    Auth::logout();

    $user->delete();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->to('/');
  }
  public function update_password(Request $request): RedirectResponse
  {
    $validated = $request->validateWithBag('updatePassword', [
      'current_password' => ['required', 'current_password'],
      'password' => ['required', Password::defaults(), 'confirmed'],
    ]);

    $request->user()->update([
      'password' => Hash::make($validated['password']),
    ]);

    Alert::success('Password Updated successfully');
    return back()->with('status', 'password-updated');
  }
}
