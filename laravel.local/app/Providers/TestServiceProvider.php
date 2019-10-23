<?php


namespace App\Providers;


use App\Services\HelloRussian;
use App\Services\HelloSeviceInterface;
use Illuminate\Support\ServiceProvider;

class TestServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(HelloSeviceInterface::class, function () {
            return new HelloRussian();
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
