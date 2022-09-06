<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->fungsiHelper();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Paginator::useBootstrap();
        config(['app.locale' => 'id']);
        Carbon::setLocale('id');
    }
    protected function fungsiHelper()
    {
        foreach (glob(__DIR__ . '/../Helpers/*.php') as $namafile) {
            require_once $namafile;
        }
    }
}
