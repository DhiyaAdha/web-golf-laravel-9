<?php

namespace Database\Seeders;

use App\Models\Detail;
use App\Models\Package;
use App\Models\Visitor;
use Faker\Factory as Faker;
use App\Models\LogTransaction;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetailSeeder extends Seeder
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
        for($i = 1; $i <= 300; $i++) {
            DB::table('detail_transactions')->insert([

                'log_transaction_id' => LogTransaction::all()->random()->id,
                'package_id' => Package::all()->random()->id,
                'quantity' => $faker->numberBetween(1, 10),
                'harga' => $faker->randomFloat(2, 0, 1000000)
            ]);
        }
    }
    
}
