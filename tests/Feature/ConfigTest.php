<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ConfigTest extends TestCase
{
    public function test_getConfigContoh()
    {
        $firstName = config("contoh.author.first");
        $lastName = config("contoh.author.last");
        $email = config("contoh.email");
        $web = config("contoh.web");

        self::assertEquals("Riefqi", $firstName);
        self::assertEquals("Alviansyah", $lastName);
        self::assertEquals("riefqi.alviansyah1430@gmail.com", $email);
        self::assertEquals("qii.web.app", $web);
    }
}
