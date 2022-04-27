<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Rumah;

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
        $rumah = Rumah::where("status", "Proses")->get();
    }
}
