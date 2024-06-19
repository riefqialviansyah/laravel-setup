<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewTest extends TestCase
{
    public function test_view()
    {
        $this->get("/hello")
            ->assertSeeText("Hello Riefqi Alviansyah");

        $this->get("/hello2")
            ->assertSeeText("Hello Dwi Alviansyah");
    }

    public function test_nested()
    {
        $this->get("/hello-world")
            ->assertSeeText("World Dwi Alviansyah");
    }

    public function test_viewWithoutRoute()
    {
        $this->view("hello", ["name" => "Akbar"])
            ->assertSeeText("Hello Akbar");
    }

    public function test_parameter()
    {
        $this->get("/products/1")
            ->assertSeeText("Product 1");
        $this->get("/products/2")
            ->assertSeeText("Product 2");

        $this->get("/products/5/items/xxx")
            ->assertSeeText("Product 5, Item xxx");
    }

    public function testRouteparameterRegex()
    {
        $this->get("/category/12345")
            ->assertSeeText("Category : 12345");
            
        $this->get("/category/salah")
            ->assertSeeText("404 by Riefqi Alviansyah");

    }

    public function test_routeOptionalParameter()
    {
        $this->get("/users/12345")->assertSeeText("Users : 12345");
        $this->get("/users/")->assertSeeText("Users : 404");
    }

    public function test_routeConflict()
    {
        $this->get("/conflict/budi")->assertSeeText("Conflict budi"); 
        $this->get("/conflict/riefqi")->assertSeeText("Conflict riefqi"); 
    }

    public function test_namedRoute()
    {
        $this->get("/produk/12345")->assertSeeText("products/12345");
        $this->get("/produk-redirect/12345")->assertRedirect("products/12345");
    }
}
