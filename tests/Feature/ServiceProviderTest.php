<?php

namespace Tests\Feature;

use App\Data\Bar;
use App\Data\Foo;
use App\Services\HelloServices;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ServiceProviderTest extends TestCase
{
    public function test_serviceProvider()
    {
        $foo = $this->app->make(Foo::class);
        $bar = $this->app->make(Bar::class);
        
        self::assertSame($foo, $bar->foo);
    }

    public function test_property()
    {
        $helloService1 = $this->app->make(HelloServices::class);
        $helloService2 = $this->app->make(HelloServices::class);

        self::assertSame($helloService1, $helloService2);
        self::assertEquals("Halo Riefqi", $helloService1->hello("Riefqi"));
    }

    public function test_empty()
    {
        self::assertTrue(true);
    }
}
