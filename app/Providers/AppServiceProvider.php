<?php

namespace App\Providers;
use App\Modulo;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // view()->composer('layouts.AdminLTE.sidebar', function($view) {
        //     $view->with('modulos', Modulo::menus());
        // });
    }
}
