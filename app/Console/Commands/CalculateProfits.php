<?php

namespace App\Console\Commands;

use App\Models\UserInvestment;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Console\Scheduling\Schedule;
use Log;

class CalculateProfits extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:calculate-profits';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculating profits for all active users investments';

    /**
     * Execute the console command.
     */

    public function handle()
    {

        $userInvestments = UserInvestment::where('status', 'active')->get();

        foreach ($userInvestments as $investment) {

            $plan = $investment->investmentPlan;
            $now = now(); // Get the current time

            // Use 'last_profit_update' or fallback to 'start_time'
            $lastProfitUpdate = $investment->last_profit_update ?? $investment->start_time;

            // Ensure both are Carbon instances
            $lastProfitUpdate = Carbon::parse($lastProfitUpdate);
            $now = Carbon::parse($now);

            // Calculate elapsed time in minutes
            $elapsedMinutes = $lastProfitUpdate->diffInMinutes($now);


            if ($elapsedMinutes > 0) {
                // Convert minutes to hours for calculation
                $elapsedHours = $elapsedMinutes / 60;

                $profitRate = $plan->rate; // Assuming hourly profit rate
                $newProfit = ($investment->amount * $profitRate / 100) * $elapsedHours;

                $investment->accumulated_profit += $newProfit;


                // Check if the investment has reached the end time
                if ($now->greaterThanOrEqualTo($investment->end_time)) {
                    $investment->status = 'completed';

                    // Add both the initial investment and the accumulated profit to the invest_balance
                    $investment->user->invest_balance += $investment->amount + $investment->accumulated_profit;
                    $investment->user->save();
                }

                // Update the 'last_profit_update' field
                $investment->last_profit_update = $now;

                // Save the updated investment record
                $investment->save();
            } else {
                Log::info('No time has passed since the last profit update.');
            }
        }
    }


}
