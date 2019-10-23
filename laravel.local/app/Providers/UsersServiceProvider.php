<?php

namespace App\Providers;


use App\Services\UsersManager;
use Illuminate\Support\ServiceProvider;

class UsersServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UsersManager::class, function () {
            return new UsersManager();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
