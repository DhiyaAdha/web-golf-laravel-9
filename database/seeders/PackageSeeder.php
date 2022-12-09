<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Seeder;

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
            'name' => 'Sewa Golf Cart pendek',
            'price_discount' => 150000,
            'price_weekdays' => 150000,
            'price_weekend' => 150000,
            'category' => 'rental',
            'status' => '0',
        ]);
        Package::create([
            'name' => 'Sewa Stik Golf',
            'price_discount' => 150000,
            'price_weekdays' => 150000,
            'price_weekend' => 150000,
            'category' => 'rental',
            'status' => '0',
        ]);
        Package::create([
            'name' => 'Glove Mizuno',
            'price_discount' => 100000,
            'price_weekdays' => 100000,
            'price_weekend' => 100000,
            'category' => 'additional',
            'status' => '0',
        ]);
        Package::create([
            'name' => '100 Bola Driving (siang)',
            'price_discount' => 50000,
            'price_weekdays' => 50000,
            'price_weekend' => 50000,
            'category' => 'default',
            'status' => '0',
        ]);
        Package::create([
            'name' => 'Soft Drink',
            'price_discount' => 10000,
            'price_weekdays' => 10000,
            'price_weekend' => 10000,
            'category' => 'others',
            'status' => '0',
        ]);
        Package::create([
            'name' => 'Aqua 600ml',
            'price_discount' => 5000,
            'price_weekdays' => 5000,
            'price_weekend' => 5000,
            'category' => 'others',
            'status' => '0',
        ]);
        Package::create([
            'name' => 'Teh Panas',
            'price_discount' => 10000,
            'price_weekdays' => 10000,
            'price_weekend' => 10000,
            'category' => 'others',
            'status' => '0',
        ]);
        Package::create([
            'name' => 'Fresh Tea',
            'price_discount' => 10000,
            'price_weekdays' => 10000,
            'price_weekend' => 10000,
            'category' => 'others',
            'status' => '0',
        ]);
        Package::create([
            'name' => 'Kopi',
            'price_discount' => 10000,
            'price_weekdays' => 10000,
            'price_weekend' => 10000,
            'category' => 'others',
            'status' => '0',
        ]);
        Package::create([
            'name' => 'Puply Orange',
            'price_discount' => 10000,
            'price_weekdays' => 10000,
            'price_weekend' => 10000,
            'category' => 'others',
            'status' => '0',
        ]);
        Package::create([
            'name' => 'Sampoerna Mild',
            'price_discount' => 30000,
            'price_weekdays' => 30000,
            'price_weekend' => 30000,
            'category' => 'others',
            'status' => '0',
        ]);
        Package::create([
            'name' => 'green Fee',
            'price_discount' => 250000,
            'price_weekdays' => 300000,
            'price_weekend' => 500000,
            'category' => 'default',
            'status' => '0',
        ]);
        Package::create([
            'name' => 'Pocari Sweat',
            'price_discount' => 10000,
            'price_weekdays' => 10000,
            'price_weekend' => 10000,
            'category' => 'others',
            'status' => '0',
        ]);
        Package::create([
            'name' => '50 Bola Driving (siang)',
            'price_discount' => 30000,
            'price_weekdays' => 30000,
            'price_weekend' => 30000,
            'category' => 'default',
            'status' => '0',
        ]);
        Package::create([
            'name' => '100 Bola Driving (malam)',
            'price_discount' => 75000,
            'price_weekdays' => 75000,
            'price_weekend' => 75000,
            'category' => 'default',
            'status' => '0',
        ]);
        Package::create([
            'name' => 'Servis Fee 100 Bola Driving (malam)',
            'price_discount' => 25000,
            'price_weekdays' => 25000,
            'price_weekend' => 25000,
            'category' => 'service',
            'status' => '0',
        ]);
        Package::create([
            'name' => 'Servis Fee 50 Bola Driving (malam)',
            'price_discount' => 10000,
            'price_weekdays' => 10000,
            'price_weekend' => 10000,
            'category' => 'service',
            'status' => '0',
        ]);
        Package::create([
            'name' => '50 Bola Driving (malam)',
            'price_discount' => 50000,
            'price_weekdays' => 50000,
            'price_weekend' => 50000,
            'category' => 'default',
            'status' => '0',
        ]);
        Package::create([
            'name' => 'Glove',
            'price_discount' => 150000,
            'price_weekdays' => 150000,
            'price_weekend' => 150000,
            'category' => 'additional',
            'status' => '0',
        ]);
        Package::create([
            'name' => 'Sewa Glove Cart Panjang',
            'price_discount' => 200000,
            'price_weekdays' => 200000,
            'price_weekend' => 200000,
            'category' => 'rental',
            'status' => '0',
        ]);
        Package::create([
            'name' => 'Foto Prewedding',
            'price_discount' => 500000,
            'price_weekdays' => 500000,
            'price_weekend' => 500000,
            'category' => 'additional',
            'status' => '0',
        ]);
        Package::create([
            'name' => 'Foto Album Sekolah',
            'price_discount' => 500000,
            'price_weekdays' => 500000,
            'price_weekend' => 500000,
            'category' => 'additional',
            'status' => '0',
        ]);
        Package::create([
            'name' => 'Tutup Lapangan',
            'price_discount' => 25000000,
            'price_weekdays' => 25000000,
            'price_weekend' => 25000000,
            'category' => 'additional',
            'status' => '0',
        ]);
        Package::create([
            'name' => 'Bola Second Titleist Provi',
            'price_discount' => 250000,
            'price_weekdays' => 250000,
            'price_weekend' => 250000,
            'category' => 'additional',
            'status' => '0',
        ]);
        Package::create([
            'name' => 'Bola Second Campur',
            'price_discount' => 100000,
            'price_weekdays' => 100000,
            'price_weekend' => 100000,
            'category' => 'additional',
            'status' => '0',
        ]);
        Package::create([
            'name' => 'Tee',
            'price_discount' => 45000,
            'price_weekdays' => 45000,
            'price_weekend' => 45000,
            'category' => 'additional',
            'status' => '0',
        ]);
        Package::create([
            'name' => 'Evolution',
            'price_discount' => 35000,
            'price_weekdays' => 35000,
            'price_weekend' => 35000,
            'category' => 'others',
            'status' => '0',
        ]);
    }
}