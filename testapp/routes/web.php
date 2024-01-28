<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::controller(BookController::class)->group(function(){
    Route::get("/book",'index')->name("/book");
    Route::get("/add-book",'addBook');
    Route::post("/store ",'store');
});

Route::get('/', function () {
    return view('welcome');
});
