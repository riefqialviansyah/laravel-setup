<?php

namespace Tests\Feature;

use App\Services\HelloServices;
use App\Services\HelloServiceIndonesia;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HelloServiceTest extends TestCase
{
    public function test_helloService()
    {
        $this->app->singleton(HelloServices::class, HelloServiceIndonesia::class);

        $helloService = $this->app->make(HelloServices::class);
        self::assertEquals("Halo Riefqi", $helloService->hello("Riefqi"));
    }
}
