<?php

use App\Http\Controllers\HelloController;
use App\Http\Controllers\InputController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get("/qii", function (){
    return "Hello Riefqi Alviansyah";
});

Route::redirect("/youtube", "/qii");

Route::fallback(function(){
    return "404 by Riefqi Alviansyah";
});

Route::view("/hello", "hello", ["name"=> "Riefqi Alviansyah"]);
Route::get("/hello2", function(){
    return view("hello", ["name"=>"Dwi Alviansyah"]);
});

Route::get("/hello-world", function(){
    return view("hello.world", ["name"=>"Dwi Alviansyah"]);
});

Route::get("/products/{id}", function($productId){
    return "Product $productId";
})->name("product.detail");

Route::get("/products/{product}/items/{items}", function($productId, $itemId){
    return "Product $productId, Item $itemId";
});

Route::get("/category/{id}", function($categoryId){
    return "Category : " . $categoryId;
})->where("id", "[0-9]+");


Route::get("/users/{id?}", function($userId = "404"){
    return "Users : $userId";
});

Route::get("/conflict/riefqi", function(){
    return "Conflict riefqi";
});

Route::get("/conflict/{name}", function($name){
    return "Conflict $name";
});

Route::get("/produk/{id}", function($id){
    $link = route('product.detail', [
        "id" => $id
    ]);
    return "Link : $link";
});

Route::get("/produk-redirect/{id}", function ($id){
    return redirect()->route("product.detail", [
        "id"=> $id
    ]);
});

Route::get("/controller/hello", [HelloController::class, "helloWorld"]);
Route::get("/controller/helloWithInput", [HelloController::class, "helloWithInput"]);
Route::post("/controller/helloWithInput", [HelloController::class, "helloWithInput"]);
Route::get("/controller/hello/request", [HelloController::class, "request"]);
Route::post("/controller/hello/input", [HelloController::class, "helloInput"]);
Route::post("/controller/hello/array", [HelloController::class, "arrayInput"]);
Route::get("/controller/hello/{name}", [HelloController::class, "hello"]);

Route::post("/input/type", [InputController::class, "inputType"]);
Route::post("/input/filter/only", [InputController::class, "filterOnly"]);
Route::post("/input/filter/except", [InputController::class, "filterExcept"]);