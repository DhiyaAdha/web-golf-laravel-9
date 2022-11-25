<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
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
        for($i = 1; $i <= 5; $i++) {
            DB::table('log_transactions')->insert([
                'order_number' => $faker->unique()->numberBetween,
                'visitor_id' => $i,
                'user_id' => User::all()->random()->id,
                'cart' => 'O:29:"Illuminate\Support\Collection":2:{s:8:"*items";a:1:{i:0;a:6:{s:5:"rowId";s:2:"27";s:4:"name";s:5:"earum";s:3:"qty";i:1;s:11:"pricesingle";i:250000;s:5:"price";i:250000;s:10:"created_at";s:19:"2022-10-09 09:48:07";}}s:28:"*escapeWhenCastingToString";b:0;}',
                'payment_type' => 'a:2:{i:0;a:4:{s:12:"payment_type";s:7:"deposit";s:18:"transaction_amount";d:0;s:7:"balance";i:250000;s:8:"discount";i:0;}i:1;a:4:{s:12:"payment_type";s:5:"kupon";s:18:"transaction_amount";i:250000;s:7:"balance";i:7;s:8:"discount";i:250000;}}',
                'payment_status' => $faker->randomElement(['paid', 'unpaid']),
                'total' => $faker->randomFloat(2, 0, 10000000),
                'created_at' => \Carbon\Carbon::now()->addMinutes(rand(0,
                60 * 23))->addSeconds(rand(0, 60)),

            ]);
        }
    }
}
