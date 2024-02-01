<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Authentication;
use App\Http\Controllers\Api\A_BookController;
use App\Http\Controllers\Api\A_GraduationProjectsController;
use App\Http\Controllers\Api\A_ScientificJournalsController;
use App\Http\Controllers\Api\A_UserLoanController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//login api rout
Route::post('/login', [Authentication::class,'login']);

//book api routs
Route::get('/book', [A_BookController::class,'index']);
Route::get('/book/{cat_name}', [A_BookController::class,'getBook']);
Route::post('/book/search', [A_BookController::class,'searchBook']);
Route::get('/lastbook', [A_BookController::class,'lastBook']);
Route::get('/mostborrowed', [A_BookController::class,'mostborrowed']);

//project api routs
Route::get('/project', [A_GraduationProjectsController::class,'index']);
Route::get('/project/{dep_name}', [A_GraduationProjectsController::class,'getProjects']);
Route::post('/project/search', [A_GraduationProjectsController::class,'searchProjects']);

//Journals api routs
Route::get('/Journals', [A_ScientificJournalsController::class,'index']);
Route::post('/Journals/search', [A_ScientificJournalsController::class,'searchJournals']);


//loan api routs
Route::get('/loans/{user_id}', [A_UserLoanController::class,'getUserLoans']);
