<?php

namespace App\Console;

use Carbon\Carbon;

use App\Models\User;
use App\Models\Visitor;
use App\Models\LogLimit;
use App\Models\ReportLimit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected $commands = [
        Commands\expiredMember::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
        
            LogLimit::whereHas('visitor', function($query) {
                $query->where('tipe_member', 'VVIP');
            })->update(['quota'=>10]);
            LogLimit::whereHas('visitor', function($query) {
                $query->where('tipe_member', 'VIP');
            })->update(['quota'=>4]);
            
            $visitor = Visitor::where('status', 'active')->get();

            foreach($visitor as $value){
                if($value->tipe_member == 'VVIP'){
                    ReportLimit::create([
                        'visitor_id' => $value['id'],
                        'user_id' => '1',
                        'report_quota' => $value['tipe_member'] == 'VIP' ? '4' : '10',
                        'status' => 'Reset',
                        'created_at' => Carbon::now(),
                    ]);
                }else{
                    ReportLimit::create([
                        'visitor_id' => $value['id'],
                        'user_id' => '1',
                        'report_quota' => $value['tipe_member'] == 'VIP' ? '4' : '10',
                        'status' => 'Reset',
                        'created_at' => Carbon::now(),
                    ]);
                }
            }
        })->monthly();
        $schedule->command('command:member')->cron('59 23 * * *');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
