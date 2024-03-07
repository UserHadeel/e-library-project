<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Authentication;
use App\Http\Controllers\Api\A_BookController;
use App\Http\Controllers\Api\A_GraduationProjectsController;
use App\Http\Controllers\Api\A_ScientificJournalsController;
use App\Http\Controllers\Api\A_BookLoanController;
use App\Http\Controllers\Api\A_ProjectLoanController;
use App\Http\Controllers\Api\A_CategoryController;
use App\Http\Controllers\Api\A_UserProfileController;
use App\Http\Controllers\Api\A_DepartmentController;

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
Route::delete('/user/{id}', [Authentication::class,'delete']);

//book api routs
Route::get('/book', [A_BookController::class,'index']);
Route::get('/book/{cat_name}', [A_BookController::class,'getBook']);
Route::post('/book/search', [A_BookController::class,'searchBook']);
Route::get('/lastbook', [A_BookController::class,'lastBook']);
Route::get('/mostborrowed', [A_BookController::class,'mostborrowed']);

// Route::get('books/{id}/image', [A_BookController::class, 'getImage']);
// Route::get('/books/{id}', [A_BookController::class,'download']);

//project api routs
Route::get('/project', [A_GraduationProjectsController::class,'index']);
Route::get('/project/{dep_name}', [A_GraduationProjectsController::class,'getProjects']);
Route::post('/project/search', [A_GraduationProjectsController::class,'searchProjects']);

//Journals api routs
Route::get('/Journals', [A_ScientificJournalsController::class,'index']);
Route::post('/Journals/search', [A_ScientificJournalsController::class,'searchJournals']);

//category api routs
Route::get('/category', [A_CategoryController::class,'index']);

//department api routs
Route::get('/department', [A_DepartmentController::class,'index']);


//loan api routs
Route::get('/loansbook/{user_id}', [A_BookLoanController::class,'getBookLoans']);
Route::post('/book-loans', [A_BookLoanController::class, 'storeBookLoan']);

Route::get('/loansproject/{user_id}', [A_ProjectLoanController::class,'getProjectLoans']);
Route::post('/project-loans', [A_ProjectLoanController::class, 'storeProjectLoan']);



Route::get('/profile', [A_UserProfileController::class, 'index']);
Route::get('/profile/{user_id}', [A_UserProfileController::class, 'getUser']);

// Route::get('/profile $user => id', [A_UserProfileController::class, 'index']);
Route::get('/profile/get', 'A_UserProfileController@getUserDetails');


Route::get('/profile/edit', 'A_UserProfileController@edit');
Route::put('/profile/update/{user_id}', [A_UserProfileController::class, 'update']);
Route::delete('/profile/destroy', 'A_UserProfileController@destroy');
