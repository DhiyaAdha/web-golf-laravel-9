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
<<<<<<< HEAD
            'email' => 'imasnurdianto@gmail.com',
            'name' => 'imas',
=======
            'email' => 'dhiya2@gmail.com',
            'name' => 'dhiya',
            'phone'=> '087736202888',
>>>>>>> dhiya
            'password' => Hash::make('tes'),
            'role_id' => '1',
            // 'status' => 'active',
        ]);
        
    }
}
