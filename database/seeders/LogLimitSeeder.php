<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Visitor;
use App\Models\LogLimit;
use App\Models\ReportLimit;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;

class LogLimitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
            for($i = 1; $i <= 30; $i++) {        
            $faker = Faker::create('id_ID');
            $visitor = Visitor::pluck('id');
            DB::table('log_limits')->insert([
                'visitor_id' => $i,
                'report_limit_id' => ReportLimit::all()->random()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ]);
        }
            
    }
}
