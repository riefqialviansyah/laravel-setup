<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class EnvTest extends TestCase
{
    public function test_getEnvTesting()
    {
        $appEnv = env("APP_ENV");

        self::assertEquals("testing", $appEnv);
    }

    public function test_getAppName()
    {
        $appName = env("APP_NAME");
        self::assertEquals("Laravel", $appName);
    }

    public function test_getAuthorFromExport()
    {
        self::markTestSkipped("Must be export env first");
        $author = env("AUTHOR");
        self::assertEquals("Riefqi Alviansyah", $author);
    }

    public function test_defaultValueEnv()
    {
        $defaultValue = env("TTL", "14-08-2000");
        $this->assertEquals("14-08-2000", $defaultValue);

    }

    public function test_checkAppEnv()
    {
        self::assertEquals(true, App::environment("testing"));
    }
}
