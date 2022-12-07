<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Visitor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class LogCouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 20; $i++) {
            $faker = Faker::create('id_ID');
            $visitor = Visitor::pluck('id');
            DB::table('log_coupons')->insert([
                'visitor_id' => $i,
                'quota_kupon' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
