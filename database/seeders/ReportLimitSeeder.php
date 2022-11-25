<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReportLimitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for($i = 1; $i <= 30; $i++) {
            $faker = Faker::create('id_ID');
            DB::table('report_limits')->insert([
                'visitor_id' => $i,
                'user_id' => User::all()->random()->id,
                'status' => $faker->randomElement(['Reset', 'Bertambah', 'Berkurang']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
