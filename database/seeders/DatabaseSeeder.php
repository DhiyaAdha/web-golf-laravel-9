<?php

namespace Database\Seeders;

use App\Models\Visitor;
use Faker\Factory as Faker;
use App\Models\PackageDefault;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(VisitorSeeder::class);
        $this->call(PackageSeeder::class);

        
    }
}