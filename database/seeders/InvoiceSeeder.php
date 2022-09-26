<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Deposit;
use App\Models\Visitor;

use App\Models\LogLimit;
use Faker\Factory as Faker;
use App\Models\LogTransaction;
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
        $visitor = Visitor::pluck('id');
        for($i = 1; $i <= 30; $i++) {
            DB::table('log_transactions')->insert([
                'order_number' => $faker->unique()->numberBetween,
                'visitor_id' => $i,
                'user_id' => User::all()->random()->id,
                'cart' => null,
                'payment_type' => $faker->randomElement(['deposit', 'cash/transfer', 'limit bulanan', 'limit kupon']),
                'payment_status' => $faker->randomElement(['paid', 'unpaid']),
                'total' => $faker->randomFloat(2, 0, 10000000),
                'created_at' => \Carbon\Carbon::now()->addMinutes(rand(0,
                60 * 23))->addSeconds(rand(0, 60))
                
            ]);
        }
    }
}
