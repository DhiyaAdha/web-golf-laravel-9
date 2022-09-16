<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Visitor;
use App\Models\ReportDeposit;

use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReportDepositSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker::create('id_ID');
        $visitor = Visitor::pluck('id');
        for($i = 1; $i <= 30; $i++) {
            DB::table('report_deposits')->insert([
            'visitor_id' => $i,
            'user_id' => $faker->randomElement([1,2]),
            'report_balance' => $faker->randomFloat(2, 0, 10000000),
            'payment_type' => $faker->randomElement(['Cash','Transfer']),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ]);
        }
    }
}
