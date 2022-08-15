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
            'email' => 'yudistirainovis36@gmail.com',
            'name' => 'yudis',
            'phone'=> '087736202888',
            'password' => Hash::make('tes'),
            'role_id' => '1',
            // 'status' => 'active',
        ]);
        
    }
}
