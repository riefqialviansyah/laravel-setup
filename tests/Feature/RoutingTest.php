<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoutingTest extends TestCase
{
    public function test_get()
    {
        $this->get("/qii")
            ->assertStatus(200)
            ->assertSeeText("Hello Riefqi Alviansyah");
    }

    public function test_redirect()
    {
        $this->get("/youtube")
            ->assertRedirect("/qii");
    }

    public function test_fallback()
    {
        $this->get("/tidakada")
            ->assertSeeText("404 by Riefqi Alviansyah");
    }
}
