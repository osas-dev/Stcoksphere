<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\UserInvestment;
use App\Models\InvestmentPlan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class InvestmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function plans()
    {
        //
        $plans = InvestmentPlan::where('status', 'Active')->get();
        return view('user.investments.plans', compact('plans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function investments()
    {
        //
        $investments = auth()->user()->user_investment()->with('investmentPlan')->where('status', 'active')->latest()->paginate(10);
        $completed_investments = auth()->user()->user_investment()->with('investmentPlan')->where('status', 'completed')->latest()->paginate(10);
        return view('user.investments.all', compact('investments', 'completed_investments'));
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
    public function show(UserInvestment $userInvestment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserInvestment $userInvestment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function invest(Request $request)
    {
        //
        $amount = $request->amount;
        $plan = InvestmentPlan::findOrFail($request->plan_id);
        $user = auth()->user();
        $request->validate([
            'amount' => 'required|numeric|min:10', // Example validation
            'plan_id' => 'required|exists:investment_plans,id',
        ]);
        // Check if user has enough balance
        if ($user->main_balance < $amount) {
            Alert::error('Error', 'Insufficient balance');
            return back();
        } else {
            if ($amount > $plan->max_value) {
                Alert::error('Error', 'This number exceeds the maximum amount you can invest on this plan kindly choose a higher investment plan');
                return back();
            } elseif ($amount < $plan->min_value) {
                Alert::error('Error', 'This number lower than the minimum amount you can invest on this plan kindly choose a lower investment plan');
                return back();
            } else {
                $user->main_balance -= $amount;

                $user->user_investment()->create([
                    'investment_plan_id' => $plan->id,
                    'amount' => $request->amount,
                    'start_time' => Carbon::now(),
                    'end_time' => Carbon::now()->addHours($plan->duration), // Duration based on the plan
                    'status' => 'active',
                ]);

                Alert::success('Success', 'Investment started successfully');
                return redirect()->route('user.investments')->with('success', 'Investment started successfully.');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserInvestment $userInvestment)
    {
        //
    }
}
