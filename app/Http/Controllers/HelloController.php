<?php

namespace App\Http\Controllers;

use App\Services\HelloServices;
use Illuminate\Http\Request;

class HelloController extends Controller
{
    private HelloServices $helloService;

    public function __construct(HelloServices $helloService)
    {
        $this->helloService = $helloService;
    }

    public function hello(string $name):string
    {
        return $this->helloService->hello($name);
    }

    public function helloWorld(): string
    {
        return "Hello World";
    }

    public function request(Request $request): string
    {
        return $request->path() . PHP_EOL .
            $request->url() . PHP_EOL . 
            $request->fullUrl()  . PHP_EOL .
            $request->method() . PHP_EOL .
            $request->header("Accept") . PHP_EOL;           
    }

    public function helloWithInput(Request $request): string
    {
        $name = $request->input("name");
        $age = $request->input("age");
        $city = $request->input("address.city");
        return "Hello $name and $age and $city";
    }

    public function helloInput(Request $request): string
    {
        $input = $request->input();
        return json_encode($input);
    }
 
    public function arrayInput(Request $request): string
    {
        $names = $request->input("students.*.name");
        return json_encode($names);
    }

}
