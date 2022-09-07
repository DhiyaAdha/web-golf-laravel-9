<?php

namespace Database\Seeders;

use App\Models\ReportDeposit;
use Carbon\Carbon;
use App\Models\User;

use App\Models\Visitor;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepositSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $faker = Faker::create('id_ID');
        $visitor = Visitor::pluck('id');
        for($i = 1; $i <= 30; $i++) {
            DB::table('deposits')->insert([
            'visitor_id' => $faker->randomElement($visitor),
            // 'user_id' => User::all()->random()->id,
            'report_deposit_id' => ReportDeposit::all()->random()->id,
            'balance' => $faker->randomFloat(2, 0, 10000000),
            'status' => $faker->randomElement(['bertambah', 'berkurang']),
            // 'payment_type' => $faker->randomElement(['Cash','Transfer']),
            
            'created_at' => Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()->addMinutes(rand(0,
                60 * 23))->addSeconds(rand(0, 60))
            ]);
        }

    }
}