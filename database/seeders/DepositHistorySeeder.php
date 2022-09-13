<?php

namespace Database\Seeders;


use App\Models\User;


use App\Models\Visitor;
use Faker\Factory as Faker;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DepositHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // $faker = Faker::create('id_ID');
        // $visitor = Visitor::pluck('id');
        // for($i = 1; $i <= 250; $i++) {
        //     DB::table('deposit_histories')->insert([
        //     'visitor_id' => $faker->randomElement($visitor),
        //     'user_id' => User::all()->random()->id,
        //     'balance' => $faker->randomFloat(2, 0, 10000000),
        //     'activities' => $faker->randomElement(['berhasil', 'tidak berhasil']),
        //     'payment_type' => $faker->randomElement(['deposit', 'cash', 'transfer']),
        //     'created_at' => Carbon::now(),
        //     'updated_at' => \Carbon\Carbon::now()->addMinutes(rand(0,
        //         60 * 23))->addSeconds(rand(0, 60))
        //     ]);
        // }

       


    }
}
