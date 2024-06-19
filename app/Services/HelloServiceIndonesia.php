<?php 
namespace App\Services;

class HelloServiceIndonesia implements HelloServices
{
    function hello(string $name): string
    {
        return "Halo $name";
    }
}