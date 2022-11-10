<?php

namespace Database\Seeders;

use App\Models\Package;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        // Paket Bermain
        Package::create([
            'name' => '18 Holes',
            'price_weekdays' => 375000,
            'price_weekend' => 800000,
            'category' => 'default',
            'status' => '0',
        ]);
        Package::create([
            'name' => '9 Holes',
            'price_weekdays' => 212000,
            'price_weekend' => 475000,
            'category' => 'default',
            'status' => '0',
        ]);
        Package::create([
            'name' => 'Driving Golf',
            'price_weekdays' => 55000,
            'price_weekend' => 70000,
            'category' => 'default',
            'status' => '0',
        ]);

        // Paket Fasilitas
        Package::create([
            'name' => 'Golf Cart',
            'price_weekdays' => 250000,
            'price_weekend' => 400000,
            'category' => 'additional',
            'status' => '0',
        ]);
        Package::create([
            'name' => 'Stick Golf',
            'price_weekdays' => 20000,
            'price_weekend' => 30000    ,
            'category' => 'additional',
            'status' => '0',
        ]);
        Package::create([
            'name' => 'Sarung Tangan',
            'price_weekdays' => 15000,
            'price_weekend' => 20000    ,
            'category' => 'additional',
            'status' => '0',
        ]);
        Package::create([
            'name' => '100 Bola',
            'price_weekdays' => 100000,
            'price_weekend' => 120000    ,
            'category' => 'additional',
            'status' => '0',
        ]);

        // Paket Kantin
        Package::create([
            'name' => 'Soft Drink',
            'price_weekdays' => 10000,
            'price_weekend' => 12000,
            'category' => 'others',
            'status' => '0',
        ]);
        Package::create([
            'name' => 'Aqua 600ml',
            'price_weekdays' => 5000,
            'price_weekend' => 7000,
            'category' => 'others',
            'status' => '0', 
        ]);
        Package::create([
            'name' => 'Tea',
            'price_weekdays' => 5000,
            'price_weekend' => 7000,
            'category' => 'others',
            'status' => '0', 
        ]);
        Package::create([
            'name' => 'Fresh Tea',
            'price_weekdays' => 7000,
            'price_weekend' => 10000,
            'category' => 'others',
            'status' => '0', 
        ]);
        Package::create([
            'name' => 'Kopi',
            'price_weekdays' => 7000,
            'price_weekend' => 10000,
            'category' => 'others',
            'status' => '0', 
        ]);
        Package::create([
            'name' => 'Pulpy Orange',
            'price_weekdays' => 7000,
            'price_weekend' => 10000,
            'category' => 'others',
            'status' => '0', 
        ]);
        Package::create([
            'name' => 'Sampurna Mild',
            'price_weekdays' => 28000,
            'price_weekend' => 30000,
            'category' => 'others',
            'status' => '0', 
        ]);
        Package::create([
            'name' => 'Evolution',
            'price_weekdays' => 30000,
            'price_weekend' => 35000,
            'category' => 'others',
            'status' => '0', 
        ]);
    }
}
