<?php

namespace Database\Seeders;

use App\Models\Visitor;
use App\Models\PackageDefault;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // \App\Models\User::factory(10)->create();
        $this->call(UserSeeder::class);
        $faker = Faker::create('id_ID');
        for($i = 1; $i <= 500; $i++) {
            DB::table('visitors')->insert([
                'name' => $faker->name,
                'email' => preg_replace('/@example\..*/', '@example.com', $faker->unique()->safeEmail),
                'phone' => $faker->phoneNumber,
                'gender' => $faker->randomElement(['laki-laki', 'perempuan']),
                'tipe_member' => $faker->randomElement(['VIP', 'VVIP']),
                'created_at' => $faker->dateTimeThisYear(),
                // 'created_at' => \Carbon\Carbon::now()->addMinutes(rand(0,
                // 60 * 23))->addSeconds(rand(0, 60)),
                'updated_at' => \Carbon\Carbon::now()->addMinutes(rand(0,
                60 * 23))->addSeconds(rand(0, 60))
            ]);

            DB::table('packages')->insert([
                'name' => $faker->word,
                'category' => $faker->randomElement(['default', 'additonal']),
                'price_weekdays' => $faker->randomFloat(2, 0, 10000),
                'price_weekend' => $faker->randomFloat(2, 0, 10000),
                'status' => $faker->randomElement([0, 1]),
                'created_at' => $faker->dateTimeThisYear(),
                'updated_at' => \Carbon\Carbon::now()->addMinutes(rand(0,
                60 * 23))->addSeconds(rand(0, 60))
            ]);

        }
    }
}