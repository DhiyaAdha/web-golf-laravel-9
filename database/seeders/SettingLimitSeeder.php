<?php

namespace Database\Seeders;

use App\Models\SettingLimit;
use Illuminate\Database\Seeder;

class SettingLimitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SettingLimit::create([
            'tipe_member' => 'VVIP',
            'limit' => '4',
        ]);
        SettingLimit::create([
            'tipe_member' => 'VIP',
            'limit' => '2',
        ]);
    }
}
