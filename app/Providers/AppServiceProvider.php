<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

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
        if(App::environment(['staging', 'production'])){
            URL::forceScheme('https');
        }
    }
    protected function fungsiHelper()
    {
        foreach (glob(__DIR__ . '/../Helpers/*.php') as $namafile) {
            require_once $namafile;
        }
    }
}
