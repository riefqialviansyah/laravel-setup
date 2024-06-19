<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class FacadesTest extends TestCase
{
    public function test_config()
    {
        $firstName1 = config("contoh.author.first");
        $firstName2 = Config::get("contoh.author.first");

        self::assertEquals($firstName1, $firstName2);
    }

    public function test_configDependency()
    {
        $config = $this->app->make("config");

        $firstName = $config->get("contoh.author.first");
        $firstName2 = Config::get("contoh.author.first");

        self::assertEquals($firstName, $firstName2);
    }

    public function test_facadesMock()
    {
        Config::shouldReceive("get")
        ->with("contoh.author.first")
        ->andReturn("Riefqi Keren");

        $firstName = Config::get("contoh.author.first");
        self::assertEquals("Riefqi Keren", $firstName);

    }
}
