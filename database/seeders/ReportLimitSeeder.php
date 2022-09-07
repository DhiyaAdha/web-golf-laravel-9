<?php

namespace Database\Seeders;

use Carbon\Carbon;

use App\Models\User;
use App\Models\Visitor;
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
            $visitor = Visitor::pluck('id');
            $data = 
            [ 
                [
                'visitor_id' => $faker->randomElement($visitor),
                'user_id' => User::all()->random()->id,

                // 'quota' => $limit,
                'type' => $faker->randomElement(['VIP','VVIP']),
                'status' => $faker->randomElement(['berkurang','reset']),
                'report_quota_kupon' => $faker-> randomDigit(1),
                // 'activities' => '1',
                // 'quota' => $data,
                'created_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                ]
        ];
                foreach($data as $key=>$type){
                    if( $type['type'] == 'VIP' ){
                        $data[$key]['report_quota'] = '4' ;        
                    }
                    else{
                        $data[$key]['report_quota'] = '10' ;
                    }
            }
            DB::table('report_limits')->insert($data);
            
        }
    }
}
