<?php

namespace Database\Seeders;

use Carbon\Carbon;

use App\Models\Visitor;
use App\Models\LogLimit;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;

class LogLimitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
            for($i = 1; $i <= 250; $i++) {        
            $faker = Faker::create('id_ID');
            $visitor = Visitor::pluck('id');
            $data = 
            [ 
                [
                'visitor_id' => $faker->randomElement($visitor),
                // 'quota' => $limit,
                'type' => $faker->randomElement(['VIP','VVIP']),
                // 'activities' => '1',
                // 'quota' => $data,
                'created_at' => Carbon::now(),
                ]
        ];
                foreach($data as $key=>$type){
                    if( $type['type'] == 'VIP' ){
                        $data[$key]['quota'] = '4' ;        
                    }
                    else{
                        $data[$key]['quota'] = '10' ;
                    }
            }
            DB::table('log_limits')->insert($data);
            
        }
            
    }
}
