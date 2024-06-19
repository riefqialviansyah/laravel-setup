<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InputTest extends TestCase
{
    public function test_inputType()
    {
        $this->post("/input/type", [
            "name" => "Riefqi Alviansyah",
            "married" => true,
            "birth_date" => "2000-08-14"
        ])->assertSeeText("Riefqi Alviansyah")->assertSeeText("true")->assertSeeText("2000-08-14");
    }

    public function test_filterOnly()
    {
        $this->post("/input/filter/only", [
            "name"=>[
                "first" => "Riefqi",
                "middle" => "Dwi",
                "last" => "Alviansyah"
            ]
            ])->assertSeeText("Riefqi")->assertSeeText("Alviansyah")->assertDontSeeText("Dwi");
    }

    public function test_filterExcept()
    {
        $this->post("/input/filter/except", [
            "name"=> "Riefqi Alviansyah",
            "admin" => true,
            "age" => 24
            ])->assertSeeText("Riefqi Alviansyah")->assertSeeText("24")->assertDontSeeText("admin");
    }

    public function test_filterMerge()
    {
        $this->post("/input/filter/merge",[
            "name"=> "Riefqi Alviansyah",
            "admin" => true,
            "age" => 24
            ])->assertSeeText("Riefqi Alviansyah")->assertSeeText("24")->assertSeeText("false");
    }

}
