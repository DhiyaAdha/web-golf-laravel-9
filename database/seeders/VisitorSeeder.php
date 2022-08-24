<?php

namespace Database\Seeders;

use App\Models\Visitor;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VisitorSeeder extends Seeder
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
        for($i = 1; $i <= 300; $i++) {
            DB::table('visitors')->insert([
            // Visitor::create([
                'name' => $faker->name,
                // 'email' => preg_replace('/@example\..*/', '@example.com', $faker->unique()->safeEmail),
                'email' => $faker->email(),
                'phone' => $faker->phoneNumber,
                'gender' => $faker->randomElement(['laki-laki', 'perempuan']),
                'tipe_member' => $faker->randomElement(['VIP', 'VVIP']),
                'created_at' => $faker->dateTimeThisYear(),
                // 'created_at' => \Carbon\Carbon::now()->addMinutes(rand(0,
                // 60 * 23))->addSeconds(rand(0, 60)),
                'updated_at' => \Carbon\Carbon::now()->addMinutes(rand(0,
                60 * 23))->addSeconds(rand(0, 60))
            ]);
        }


    }
}
