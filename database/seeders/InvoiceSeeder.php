<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

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
        for($i = 1; $i <= 50; $i++) {
            DB::table('log_transactions')->insert([
                'visitor_id' => $faker->unique()->randomDigit(),
                'user_id' => $faker == 1,
                'payment_type' => $faker->randomElement([0, 1]),
                'payment_status' => $faker->randomElement([0, 1]),
                'total' => $faker->randomFloat(2, 0, 10000),
                'status' => $faker->randomElement([0, 1]),
                'created_at' => \Carbon\Carbon::now()->addMinutes(rand(0,
                60 * 23))->addSeconds(rand(0, 60))
            ]);
        }
    }
}
