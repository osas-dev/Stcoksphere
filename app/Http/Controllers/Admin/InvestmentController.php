<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InvestmentPlan;
use App\Models\UserInvestment;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class InvestmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $plans = InvestmentPlan::all();
        return view('admin.investments.index', compact('plans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.investments.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //create a Investment
        InvestmentPlan::create([
            'name' => $request->name,
            'rate' => $request->rate,
            'frequency' => $request->frequency,
            'duration' => $request->duration,
            'min_value' => $request->min_value,
            'max_value' => $request->max_value,
            'status' => $request->status,
        ]);

        Alert::success('Investment plan has been created');
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InvestmentPlan $plan)
    {
        //
        return view('admin.investments.edit', compact('plan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InvestmentPlan $plan)
    {
        //
        $plan->update([
            'name' => $request->name,
            'rate' => $request->rate,
            'frequency' => $request->frequency,
            'duration' => $request->duration,
            'min_value' => $request->min_value,
            'max_value' => $request->max_value,
            'status' => $request->status,
        ]);

        Alert::success('Investment plan has been updated');
        return redirect()->route('admin.plans');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InvestmentPlan $plan)
    {
        //
        $plan->delete();
        Alert::success('Investment plan has been deleted');
        return redirect()->back();
    }
    public function all()
    {
        //
        $plans = UserInvestment::latest()->paginate(15);
        return view('admin.investments.transactions.all', compact('plans'));
    }
    public function active_plans()
    {
        //
        $plans = UserInvestment::where('status', 'Active')->latest()->paginate(15);
        return view('admin.investments.transactions.active', compact('plans'));
    }
    public function completed_plans()
    {
        //
        $plans = UserInvestment::where('status', 'completed')->latest()->paginate(15);
        return view('admin.investments.transactions.completed', compact('plans'));
    }
}
