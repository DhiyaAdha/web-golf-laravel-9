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
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
        
            LogLimit::whereHas('visitor', function($query) {
                $query->where('tipe_member', 'VVIP');
            })->update(['quota'=>10]);
            LogLimit::whereHas('visitor', function($query) {
                $query->where('tipe_member', 'VIP');
            })->update(['quota'=>4]);
            
            $visitor = Visitor::all();

            foreach($visitor as $value){
                ReportLimit::create([
                    'visitor_id' => $value['id'],
                    'user_id' => '1',
                    'report_quota' => $value['tipe_member'] == 'VIP' ? '4' : '10',
                    'status' => 'reset',
                    'activities' => 'Limit melakukan reset' ,
                    'created_at' => Carbon::now(),
                ]);
            }

            // if($visitor->tipe_member == 'VIP'){
            //     $report_quota =ReportLimit::create([
            //         'visitor_id' => $visitor->id,
            //         'user_id' =>    Auth::user()->id,
            //         'report_quota' => $visitor->tipe_member == 'VIP' ? '4' : '10',
            //         'status' => 'Bertambah',
            //         // 'activities'=> 'Limit ' . $request->name . ' bertambah menjadi ' . $request->tipe_member == 'VIP' ? '4' : '10',
            //         'activities' => 'Limit <b>' . $visitor->name . '</b> bertambah menjadi <b> 4</b>',
            //         'created_at' => Carbon::now(),
            //     ]);
            // }else {
            //     $report_quota =ReportLimit::create([
            //         'visitor_id' => $visitor->id,
            //         'user_id' =>    Auth::user()->id,
            //         'report_quota' => $visitor->tipe_member == 'VIP' ? '4' : '10',
            //         'status' => 'Bertambah',
            //         // 'activities'=> 'Limit ' . $request->name . ' bertambah menjadi ' . $request->tipe_member == 'VIP' ? '4' : '10',
            //         'activities' => 'Limit <b>' . $visitor->name . '</b> bertambah menjadi <b> 10</b>',
            //         'created_at' => Carbon::now(),
            //     ]);
            // }


        })->everyMinute();
    
        // })->monthly();
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
