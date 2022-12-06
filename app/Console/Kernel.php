<?php

namespace App\Console;

use Carbon\Carbon;
use App\Models\Visitor;
use App\Models\LogLimit;
use App\Models\ReportLimit;
use App\Models\SettingLimit;
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
            $limit_vip = SettingLimit::where('tipe_member', 'VIP')->first();
            $limit_vvip = SettingLimit::where('tipe_member', 'VVIP')->first();

            LogLimit::whereHas('visitor', function ($query) {
                $query->where('tipe_member', 'VVIP');
            })->update(['quota' => $limit_vvip->limit]);
            LogLimit::whereHas('visitor', function ($query) {
                $query->where('tipe_member', 'VIP');
            })->update(['quota' => $limit_vip->limit]);

            $visitor = Visitor::where('status', 'active')->get();
            foreach($visitor as $value) {
                if($value->tipe_member == 'VVIP') {
                    ReportLimit::create([
                        'visitor_id' => $value['id'],
                        'user_id' => '1',
                        'report_quota' => $value['tipe_member'] == 'VIP' ? $limit_vip->limit : $limit_vvip->limit,
                        'status' => 'Reset',
                        'created_at' => Carbon::now(),
                    ]);
                }else {
                    ReportLimit::create([
                        'visitor_id' => $value['id'],
                        'user_id' => '1',
                        'report_quota' => $value['tipe_member'] == 'VIP' ? $limit_vip->limit : $limit_vvip->limit,
                        'status' => 'Reset',
                        'created_at' => Carbon::now(),
                    ]);
                }
            }
        })->monthly();
        $schedule->command('command:reset_log')->yearly();
        $schedule->command('command:member')->cron('59 23 * * *');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
