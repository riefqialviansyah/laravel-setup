<?php

namespace App\Providers;

use App\Data\Bar;
use App\Data\Foo;
use App\Services\HelloServiceIndonesia;
use App\Services\HelloServices;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class FooBarServiceProvider extends ServiceProvider implements DeferrableProvider
{

    public array $singletons =[
        HelloServices::class => HelloServiceIndonesia::class
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // echo "Load foobarserviceprovider" . PHP_EOL; // ujicoba apakah provider akan terload atau nggak ketika tidak dibutuhkan
        $this->app->singleton(Foo::class, function(){
            return new Foo();
        });

        $this->app->singleton(Bar::class, function($app){
            return new Bar($app->make(Foo::class));
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    public function provides()
    {
        return [HelloServices::class, Foo::class, Bar::class];
    }
}
