<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PackageSeeder extends Seeder
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
        for ($i = 1; $i <= 30; $i++) {
            DB::table('packages')->insert([
                'name' => $faker->word,
                'category' => $faker->randomElement(['default', 'additional']),
                'price_weekdays' => $faker->randomFloat(2, 0, 10000),
                'price_weekend' => $faker->randomFloat(2, 0, 10000),
                'status' => $faker->randomElement([0, 1]),
                'created_at' => $faker->dateTimeThisYear(),
                'updated_at' => \Carbon\Carbon::now()
                    ->addMinutes(rand(0, 60 * 23))
                    ->addSeconds(rand(0, 60)),
            ]);
        }
    }
}
