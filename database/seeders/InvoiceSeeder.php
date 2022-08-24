<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Visitor;
use App\Models\LogTransaction;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        // LogTransaction::truncate();
        $visitor = Visitor::pluck('id');
        for($i = 1; $i <= 50; $i++) {
            DB::table('log_transactions')->insert([
                
                // 'region_id' => Region::all()->random()->id,
                'visitor_id' => $faker->randomElement($visitor),
                'user_id' => User::all()->random()->id,

                'payment_type' => $faker->randomElement(['Cash','Transfer']),
                'payment_status' => $faker->randomElement([0, 1]),
                'total' => $faker->randomFloat(2, 0, 10000),
                'status' => $faker->randomElement([0, 1]),
                'created_at' => \Carbon\Carbon::now()->addMinutes(rand(0,
                60 * 23))->addSeconds(rand(0, 60))
            ]);
        }
    }
}