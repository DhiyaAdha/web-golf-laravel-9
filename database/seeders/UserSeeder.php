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
            'email' => 'imasnurdianto2002@gmail.com',
            'name' => 'imas',
            'phone' => '087736202888',
            'password' => Hash::make('tes'),
            'role_id' => '1',
        ]);

        User::create([
            'email' => 'dhiya@gmail.com',
            'name' => 'dhiya',
            'phone' => '08733302888',
            'password' => Hash::make('tes'),
            'role_id' => '2',
        ]);

        User::create([
            'email' => 'zaenury5868@gmail.com',
            'name' => 'dhany',
            'phone' => '082214515603',
            'password' => Hash::make('tes'),
            'role_id' => '2',
        ]);
    }
}
