<?php

namespace Database\Seeders;

use App\Models\Visitor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

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
