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
            'email' => 'kasir01@tritihgolf.com',
            'name' => 'Kasir',
            'phone' => '082214515605',
            'password' => Hash::make('Tritihgolf123!'),
            'role_id' => '1',
        ]);

        User::create([
            'email' => 'admin@tritihgolf.com',
            'name' => 'Admin TGCC',
            'phone' => '08733302888',
            'password' => Hash::make('Tritihgolf123!'),
            'role_id' => '2',
        ]);
    }
}
