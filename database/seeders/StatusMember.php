<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StatusMember extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
    }

    public function definition()
    {
        return [

            'name' => 'imas',
            'email' => 'dhiya@gmail.com',
            'phone'=> '087736202888',


            // 'status' => collect(['VIP', 'VVIP'])->random(1), [0],
            //status untuk enum

            // 'email' => 'dhiya@gmail.com',
            // 'name' => 'dhiya',
            // 'phone'=> '087736202888',
        ];

    }
}
