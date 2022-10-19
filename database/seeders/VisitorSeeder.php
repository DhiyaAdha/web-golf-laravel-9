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
        $faker = Faker::create('id_ID');
        for ($i=0; $i < 30; $i++) { 
            Visitor::create([
                'unique_qr' => 'http://127.0.0.1:8000/kartu-member/'.$i.'?qr=2022-10-Ecyzf0pYBcP6Xda&signature=eee291ddf516c915c4290838dd1d25a715738ef218139625ab315e3e192decf9',
                'name' => $faker->name(),
                'email' => $faker->email(),
                'phone'=> $faker->numerify('08#########'),
                'address' => $faker->address(),
                'company' => $faker->company(),
                'position' => $faker->randomElement(['Direktur', 'Seketaris','HRD', 'CEO']),
                'category' => $faker->randomElement(['pertamina', 'pensiunan', 'forkopimda', 'perpesi', 'umum']),
                'gender' => $faker->randomElement(['laki-laki', 'perempuan']),
                'tipe_member' => $faker->randomElement(['VIP', 'VVIP']),
                'created_at' => $faker->dateTimeThisYear(),
                'updated_at' => \Carbon\Carbon::now()->addMinutes(rand(0,
                60 * 23))->addSeconds(rand(0, 60))
            ]);
        }
    }
}
