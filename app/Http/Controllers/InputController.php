<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InputController extends Controller
{
    public function inputType(Request $request): string
    {
        $name = $request->input("name");
        $married = $request->boolean("married");
        $birtDate = $request->date("birth_date", 'Y-m-d');

        return json_encode([
            "name" => $name,
            "married" => $married,
            "birt_date" => $birtDate->format("Y-m-d")
        ]);
    }

    public function filterOnly(Request $request): string
    {
        $name = $request->only(["name.first", "name.last"]);
        return json_encode($name);
    }

    public function filterExcept(Request $request): string
    {
        $user = $request->except(["admin"]);
        return json_encode($user);
    }
}
