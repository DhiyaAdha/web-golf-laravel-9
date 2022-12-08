<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Visitor;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class LogTransaction extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($i = 1; $i <=500000; $i++){
            $faker = Faker::create('id_ID');
            $visitor = Visitor::pluck('id');
            DB::table('log_transactions')->insert([
                'visitor_id' => 2,
                'id' => $i,
                'order_number' => $faker->name,
                'user_id' => 2,
                'cart' => $faker->name,
                'payment_type' => $faker->name,
                'payment_status' => $faker->randomElement(['paid', 'unpaid']),
                'total' => $faker->randomFloat(2, 0, 10000000),
                'total_gross' => $faker->randomFloat(2, 0, 10000000),
                'jml_default' => $faker->randomFloat(2, 0, 10000000),
                'jml_additional' => $faker->randomFloat(2, 0, 10000000),
                'jml_other' => $faker->randomFloat(2, 0, 10000000),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
