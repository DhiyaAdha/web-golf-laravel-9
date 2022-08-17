<?php

namespace Database\Seeders;

use App\Models\Visitor;
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
        // $this->call(UserSeeder::class);
        $this->call(StatusMember::class);


        $faker = Faker::create('id_ID');

        for($i = 1; $i <= 20; $i++) {

        DB::table('visitors')->insert([
 
        // 'id' => Visitor::all()->random()->id,
        'name' => $faker->name,
        'email' => preg_replace('/@example\..*/', '@example.com', $faker->unique()->safeEmail),
        'phone' => $faker->phoneNumber,
        'gender' => $faker->randomElement(['laki-laki', 'perempuan']),
        'tipe_member' => $faker->randomElement(['VIP', 'VVIP']),
        'created_at' => \Carbon\Carbon::now()->addMinutes(rand(0,
        60 * 23))->addSeconds(rand(0, 60)),
        'updated_at' => \Carbon\Carbon::now()->addMinutes(rand(0,
        60 * 23))->addSeconds(rand(0, 60))
        ]);


        // 'id', 'name', 'gender', 'tipe_member'
        }
    }
}

