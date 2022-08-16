<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email' => 'zaenury5868@gmail.com',
            'name' => 'dhany',
            'phone'=> '087736202888',
            'password' => Hash::make('tes'),
            'role_id' => '2',
            // 'status' => 'active',

        ]);
        

    }
}
