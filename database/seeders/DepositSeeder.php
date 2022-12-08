<?php

namespace Database\Seeders;

use App\Models\ReportDeposit;
use App\Models\Visitor;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepositSeeder extends Seeder
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
        for($i = 1; $i <= 20; $i++) {
            DB::table('deposits')->insert([
                'visitor_id' => $i,
                'report_deposit_id' => ReportDeposit::all()->random()->id,
                'balance' => $faker->randomFloat(2, 0, 10000000),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

    }
}
