<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ControllerTest extends TestCase
{
    public function test_helloWorld()
    {
        $this->get("/controller/hello")->assertSeeText("Hello World");
    }

    public function test_controller()
    {
        $this->get("/controller/hello/Riefqi")->assertSeeText("Halo Riefqi");
    }

    public function test_request()
    {
        $this->get("/controller/hello/request", [
            "Accept" => 'plain/text'
        ])->assertSeeText("controller/hello/request")->assertSeeText("http://localhost/controller/hello/request")->assertSeeText("GET")->assertSeeText("plain/text");
    }

    public function test_input()
    {
        $this->get("/controller/helloWithInput?name=Riefqi&age=24")->assertSeeText("Hello Riefqi and 24");
        $this->post("/controller/helloWithInput", [
            "name" => "Riefqi Alviansyah",
            "age" => 24,
            "address" => [
                "city" => "Lombok Timur"
            ]
        ])->assertSeeText("Hello Riefqi Alviansyah and 24 and Lombok Timur");
    }

    public function test_helloInput()
    {
        $this->post("/controller/hello/input", [
            "name" => "Riefqi Alviansyah",
            "age" => 24,
            "address" => [
                "city" => "Lombok Timur",
                "country" => "Indonesia"
            ]
            ])->assertSeeText("Riefqi Alviansyah")->assertSeeText("24")->assertSeeText("Lombok Timur")->assertSeeText("Indonesia");
    }

    public function test_arrayInput()
    {
        $this->post("/controller/hello/array",[
                    "students" => [
                        [
                            "name" => "Riefqi Alviansyah",
                            "age" => 24
                        ],
                        [
                            "name" => "Ali Akbar",
                            "age" => 8
                        ]
                    ]
                ])->assertSeeText("Riefqi Alviansyah")->assertSeeText("Ali Akbar");
    }
  
}
