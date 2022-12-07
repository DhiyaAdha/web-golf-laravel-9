<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(VisitorSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(PackageSeeder::class);
        $this->call(SettingLimitSeeder::class);
        $this->call(ReportDepositSeeder::class);
        $this->call(DepositSeeder::class);
        $this->call(ReportLimitSeeder::class);
        $this->call(LogLimitSeeder::class);
        $this->call(ReportCouponSeeder::class);
        $this->call(LogCouponSeeder::class);
        // $this->call(InvoiceSeeder::class);
    }
}
