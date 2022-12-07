<?php

namespace Database\Seeders;

use App\Models\Visitor;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

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
        for ($i = 0; $i < 20; $i++) {
            Visitor::create([
                'unique_qr' => 'https://tritih-golf.test/kartu-member/20221207085943?e=1',
                'name' => $faker->name(),
                'email' => $faker->email(),
                'nik' => $faker->numerify('330306290194####'),
                'phone' => $faker->numerify('08#########'),
                'code_member' => $faker->numerify('08#########'),
                'address' => $faker->address(),
                'company' => $faker->company(),
                'handicap' => $faker->numerify('#'),
                'position' => $faker->randomElement(['Direktur', 'Seketaris', 'HRD', 'CEO']),
                'category' => $faker->randomElement(['pertamina', 'pensiunan', 'forkopimda', 'perpesi', 'umum']),
                'gender' => $faker->randomElement(['laki-laki', 'perempuan']),
                'tipe_member' => $faker->randomElement(['VIP', 'VVIP']),
                'status' => $faker->randomElement(['active', 'inactive']),
                'expired_date' => '2023-12-07 08:59:43',
                'created_at' => $faker->dateTimeThisYear(),
                'updated_at' => \Carbon\Carbon::now()->addMinutes(rand(0,
                60 * 23))->addSeconds(rand(0, 60)),
            ]);
        }
    }
}
