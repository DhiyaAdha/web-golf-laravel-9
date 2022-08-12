<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(UserSeeder::class);
        $this->call(StatusMember::class);


        
        
    }
}

// $faker = Faker::create('id_ID');

// for($i = 1; $i <= 10; $i++) {

//     DB::table('visitor')->insert(
//         'id' => $faker->id,
//         'name' => $faker->name,
//         'gender' => ,
//         'tipe_member' => ,


//         // 'id', 'name', 'gender', 'tipe_member'
//     );
// }