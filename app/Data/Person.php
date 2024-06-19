<?php 

namespace App\Data;

class Person 
{
    public string $firstName;
    public string $lastName;
    public function __construct(string $first, string $last)
    {
        $this->firstName = $first;
        $this->lastName = $last;
    }

}