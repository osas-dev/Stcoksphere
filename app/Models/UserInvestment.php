<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Log;

class UserInvestment extends Model
{
    //
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function investmentPlan()
    {
        return $this->belongsTo(InvestmentPlan::class);
    }

    public function calculateProfits()
    {
        $plan = $this->investmentPlan; // Get the related plan
        $now = Carbon::now();
        $startTime = Carbon::parse($this->start_time);

        // Skip calculation if investment is already completed
        if ($this->end_time <= $now || $this->status === 'completed') {
            Log::info("Skipping investment ID: {$this->id} as it's completed or past end time.");
            return;
        }

        // Calculate time difference between start and now in minutes
        $elapsedMinutes = $now->diffInMinutes($startTime);
        Log::info("Investment ID: {$this->id} has elapsed {$elapsedMinutes} minutes.");

        // Convert frequencies to minutes and calculate profit based on elapsed time
        switch ($plan->frequency) {
            case 'hourly':
                $periodMinutes = 60; // 1 hour = 60 minutes
                break;
            case 'daily':
                $periodMinutes = 60 * 24; // 1 day = 1440 minutes
                break;
            case 'weekly':
                $periodMinutes = 60 * 24 * 7; // 1 week = 10080 minutes
                break;
            case 'monthly':
                $periodMinutes = 60 * 24 * 30; // 1 month = 43200 minutes
                break;
            default:
                $periodMinutes = 0;
        }

        // Calculate how many full periods (based on frequency) have passed
        $periodsPassed = floor($elapsedMinutes / $periodMinutes);
        Log::info("Investment ID: {$this->id} has passed {$periodsPassed} periods.");

        if ($periodsPassed > 0) {
            // Calculate the new profit based on the number of periods passed
            $newProfit = ($this->amount * $plan->rate / 100) * $periodsPassed;

            // Log the calculated profit
            Log::info("Investment ID: {$this->id} calculated new profit: {$newProfit}");

            // Update the accumulated profit
            $this->accumulated_profit = $newProfit;
            $this->save();
        } else {
            Log::info("Investment ID: {$this->id} has no profit yet.");
        }

        // If investment is complete, mark as completed and update user invest_balance
        if ($now >= $this->end_time) {
            Log::info("Investment ID: {$this->id} is now completed.");
            $this->status = 'completed';
            $this->user->invest_balance += $this->amount + $this->accumulated_profit; // Add total to invest_balance
            $this->user->save();
        }
    }
}
