<?php

namespace Database\Seeders;

use App\Models\Visitor;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Hash;



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

        
        // $faker = Faker::create('id_ID');
        // for($i = 1; $i <= 300; $i++) {
        //     DB::table('visitors')->insert([
        //     // Visitor::create([
        //         'name' => $faker->name,
        //         // 'email' => preg_replace('/@example\..*/', '@example.com', $faker->unique()->safeEmail),
        //         'email' => $faker->email(),
        //         'phone' => $faker->phoneNumber,
        //         'gender' => $faker->randomElement(['laki-laki', 'perempuan']),
        //         'tipe_member' => $faker->randomElement(['VIP', 'VVIP']),
        //         'created_at' => $faker->dateTimeThisYear(),
        //         // 'created_at' => \Carbon\Carbon::now()->addMinutes(rand(0,
        //         // 60 * 23))->addSeconds(rand(0, 60)),
        //         'updated_at' => \Carbon\Carbon::now()->addMinutes(rand(0,
        //         60 * 23))->addSeconds(rand(0, 60))
        //     ]);
        // }



        // Visitor::truncate();
        $faker = Faker::create('id_ID');

        for ($i=0; $i < 10; $i++) { 
            Visitor::create([
                'name' => $faker->name(),
                'email' => $faker->email(),
                'phone'=> $faker->phoneNumber(),
                'address' => $faker->address(),
                'company' => $faker->company(),
                'gender' => $faker->randomElement(['laki-laki', 'perempuan']),
                'tipe_member' => $faker->randomElement(['VIP', 'VVIP'])
            ]);
        }
        // Visitor::create([
        //     'name' => 'kelvin',
        //     'email' => 'rijik@gmail.com',
        //     'phone'=> '0877333402821',
        //     'address' => 'pinus',
        //     'company' => 'pertamina',
        //     'gender' => 'laki-laki',
        //     'tipe_member' => 'VIP',
        // ]);
        // Visitor::create([
        //     'name' => 'rijik',
        //     'email' => 'rijik@gmail.com',
        //     'phone'=> '087732212821',
        //     'address' => 'lengkong',
        //     'company' => 'pertamina',
        //     'gender' => 'perempuan ',
        //     'tipe_member' => 'VVIP',
        // ]);

    }
}
