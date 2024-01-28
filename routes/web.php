<?php
namespace App\Http\Controllers;
use App\Models\department;
use App\Models\projectLoan;
use Illuminate\Http\Request;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\GraduationProjectsController;
use App\Http\Controllers\ProjectUserLoanController;
use App\Models\Book;
use App\Models\Category;
use App\Models\Loan;
use Carbon\Carbon;
use App\Mail\LoanMail;
use Mail;
use App\Models\ScientificJournals;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\GraduationProjects;
use Illuminate\Support\Facades\Redirect;
use App\Mail\Verified;

//////////////////////////
// TEST PURPOSES ONLY :)

Route::get('/background-book-worker/{category}/{lastBookID}/{amount}', function (string $category, int $lastBookID, int $amount) {
    $data = null;
    if($category == 'all') {
        $data = Db::select('SELECT * FROM book WHERE  id >= '.$lastBookID.' LIMIT '.$amount.';');
    }
    else {
        $data = Db::select('SELECT * FROM book WHERE cat_name = "'.$category.'" and id >= '.$lastBookID.' LIMIT '.$amount.';');
    }
    return $data;
});
//////////////////////////

Route::post("/users-update/{id}", [UserController::class, "update"]);

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



 // BOOKS
// Route::get('/get_books', function () {
//     $count = Book::all();
//     return $count->toJson();
// });

Route::resource('/book', BookController::class)->only([
    'index', 'show', 'create', 'store', 'edit', 'update', 'destroy']);
Route::post('/update-book', [BookController::class, "fetch_update"]);
Route::post('/book/search', [BookController::class, 'search'])->name('book.search');


//GraduationProjects
Route::resource('/GraduationProjects', GraduationProjectsController::class)->only([
    'index', 'show', 'create', 'store', 'edit', 'update', 'destroy']);
Route::post('/update-project', [GraduationProjectsController::class, "fetch_update"]);
Route::post('/GraduationProjects/search', [GraduationProjectsController::class, 'search'])->name('GraduationProjects.search');

//projectPage
Route::get('/projectPage', function () {
    return view('GraduationProjects.mainprojectPage',
    ['categories' => Category::all(),
    'projects' =>\App\Models\GraduationProjects::all(),'department' => department::all()]);
})->name('projectPage');


//CATEGORY
Route::resource('category', CategoryController::class)->only([
    'index', 'show', 'create', 'store', 'edit', 'update', 'destroy','search'
]);
route::post('/update/{id}',[CategoryController::class, "update"]);

//DEPARTMENT
Route::resource('department', DepartmentController::class)->only([
    'index', 'show', 'create', 'store', 'edit', 'update', 'destroy','search'
]);
route::post('/updated/{id}',[DepartmentController::class, "updated"]);

//WELCOME
Route::get('/', function () {
    return view('welcome');
});

//HOME PAGE
Route::get('/homepage/{i}/{cg}', function (string $i, string $cg) {
    $num = 10;
    $books = null;

    if (is_null($cg) || $cg == '' || $cg == 'all') {
        if(is_null($i) || $i == 'book')$books = Book::paginate($num);
        else if($i == "gp"){$books = \App\Models\GraduationProjects::paginate($num);}
    }
    else {
        if(is_null($i) || $i == 'book'){
            $books = Book::where('cat_name', $cg)->paginate($num);
        }
        else if($i == 'gp')
            $books = \App\Models\GraduationProjects::where('dep_name', $cg)->paginate($num);
    }
    return view('bookpage.mainPage',
    ['categories' => Category::all(),'books' => $books,'department' => department::all(), 'itemsShowing' => (is_null($i) ? "book" : $i == 'book') ? 'book' : 'gp']);
})->name("m-homepage");

Route::get('/homepage', function () {
    return redirect()->route('m-homepage', ['i' => 'book', 'cg' => 'all']);
})->name('homepage');



Route::get('/adminhomepage/{i}/{cg}', function (string $i,string $cg) {

    $num = 10;
    $books = null;
    if (is_null($cg) || $cg == '' || $cg == 'all') {
        if(is_null($i) || $i == 'book')$books = Book::paginate($num);
        else if($i == "gp"){$books = \App\Models\GraduationProjects::paginate($num);}
    }
    else {
        if(is_null($i) || $i == 'book'){
            $books = Book::where('cat_name', $cg)->paginate($num);
        }
        else if($i == 'gp')
            $books = \App\Models\GraduationProjects::where('dep_name', $cg)->paginate($num);
    }
    return view('admin.mainPage',
    ['categories' => Category::all(),'books' => $books,'department' => department::all(), 'itemsShowing' => is_null($i) || $i == 'book' ? 'book' : 'gp']);
})->name("m-adminhomepage");



Route::get('/adminhomepage', function () {
    return redirect()->route('m-adminhomepage', ['i' => 'book', 'cg' => 'all']);
    //Redirect::to('/adminhomepage/book/all');
})->name('adminhomepage');


Route::get('/newbooks', function () {
    return view('bookpage.newbooks',
    [   'categories' => Category::all(),
        'books' => Book::all(),
        'department' => department::all(),
        'lastNewBooks'=>Book::latest()->take(10)->get(['id','title','cat_name','author','image','available_quantity','resource', 'able_to_borrow', 'able_to_download'])]);
})->middleware(['auth', 'verified'])->name('newbooks');

Route::get('/mostborrowed', function () {
    $result = Loan::selectRaw('book.title as TITLE, loans.book_id as ID, book.author as author, book.image as imagee, book.available_quantity as available_quantity, book.resource as resourcee, count(*) as LCOUNT')
        ->join('book', 'book.id', '=', 'loans.book_id')
        ->groupBy('loans.book_id')
        ->orderByDesc('LCOUNT')
        ->limit(10)
        ->get();
    return view('bookpage.mostborrowed', [
        'categories' => Category::all(),
        'result' => $result,
        'department' => Department::all()]);
})->name('mostborrowed');


Route::post('/mainPage/search', [MainPageController::class, 'search'])->name('main.search');
Route::post('/scientificJournalsPage/search', [MainPageController::class, 'JournalsSearch'])->name('main.JournalsSearch');

//scientificJournals
Route::resource('/scientificJournals', ScientificJournalsController::class)->only([
    'index', 'show', 'create', 'store', 'edit', 'update', 'destroy']);
Route::post('/update-scientificJournals', [ScientificJournalsController::class, "fetch_update"]);
Route::post('/scientificJournals/search', [ScientificJournalsController::class, 'search'])->name('scientificJournals.search');

//scientificJournalsPage
Route::get('/scientificJournalsPage', function () {
    return view('scientificJournalsPage.index',['categories' => Category::all(),
    'scientificJournals'=>ScientificJournals::all(),
    'department' => department::all()
]);
})->name('scientificJournalsPage');



//DASHBOARD
Route::get('/dashboard', function () {

    $count = Loan::where('is_returned', 0)->count();
    $pcount = ProjectLoan::where('is_returned', 0)->count();
    return view('admin/myprofile2',
    ['books' => Book::all(),'countbook'=>Book::count(),
    'lastbook'=>Book::latest()->take(4)->get(['id','title','cat_name']),
    'users' => User::all(),'countMember'=>User::count(),
    'lastuser'=>User::latest()->take(4)->get(['name','email']),
    'loans' => Loan::where('is_returned', 0),'count'=>$count,
    'ploans' => ProjectLoan::where('is_returned', 0)->get(),'pcount' => $pcount,
    'categories' => Category::all(),'countCategory'=>Category::count(),
    'Projects' =>\App\Models\GraduationProjects::all(),'countGraduationProjects'=>\App\Models\GraduationProjects::count(),
    'lastproject'=>\App\Models\GraduationProjects::latest()->take(4)->get(['id','title','student_name','supervisor_name','dep_name']),
    'scientificJournals'=>ScientificJournals::all(),'countscientificJournals'=>ScientificJournals::count(),
    'lastJournals'=>ScientificJournals::latest()->take(4)->get(['id','title','publishing','Year_of_publication']),
]);
})->middleware(['auth', 'verified'])->name('dashboard');



//USER
Route::resource('user', UserController::class)->only([
    'index', 'show', 'create', 'store', 'edit', 'update', 'destroy'
]);
Route::get('/user/search', [UserController::class, 'search'])->name('user.search');


// Route::get('/send', function () {
//     Mail::to('hadilj99@gmail.com')->send(new Verified());
//  return response('sinding');
// });



Route::middleware('auth')->group(function () {
    Route::get('/books', [BookController::class, 'index'])->name('books.index');

    Route::get('/loans', [LoanController::class, 'index'])->name('loans.index');
    Route::get('/loans/{book}', [LoanController::class, 'create'])->name('loans.create');
    Route::post('/loans/{book}', [LoanController::class, 'store'])->name('loans.store');
    Route::get('/loans/terminate/{loan}', [LoanController::class, 'terminate'])->name('loans.terminate');

    Route::get('/projectloans', [ProjectLoanController::class, 'index'])->name('projectloans.index');
    Route::get('/projectloans/{project}', [ProjectLoanController::class, 'create'])->name('projectloans.create');
    Route::post('/projectloans/{project}', [ProjectLoanController::class, 'store'])->name('projectloans.store');
    Route::get('/projectloans/terminate/{projectLoan}', [ProjectLoanController::class, 'terminate'])->name('projectloans.terminate');

    Route::get('/userloans', [UserLoanController::class, 'index'])->name('userloans.index');
    Route::get('/userloans/{book}', [UserLoanController::class, 'create'])->name('userloans.create');
    Route::post('/userloans/{book}', [UserLoanController::class, 'store'])->name('userloans.store');
    Route::get('/userloans/terminate/{loan}', [UserLoanController::class, 'terminate'])->name('userloans.terminate');

    Route::get('/projectuserloans', [ProjectUserLoanController::class, 'index'])->name('projectuserloans.index');
    Route::get('/projectuserloans/{project}', [ProjectUserLoanController::class, 'create'])->name('projectuserloans.create');
    Route::post('/projectuserloans/{project}', [ProjectUserLoanController::class, 'store'])->name('projectuserloans.store');
    Route::get('/projectuserloans/terminate/{projectLoan}', [ProjectUserLoanController::class, 'terminate'])->name('projectuserloans.terminate');

    // Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route::get('/userprofile', [UserprofileController::class, 'index'])->name('userprofile.index');
    Route::get('/userprofile', [UserprofileController::class, 'edit'])->name('userprofile.edit');
    Route::patch('/userprofile', [UserprofileController::class, 'update'])->name('userprofile.update');
    Route::delete('/userprofile', [UserprofileController::class, 'destroy'])->name('userprofile.destroy');

    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
});



Route::get('/test', function() {

    $loans = Loan::where('is_returned', false)
        ->whereDate('return_date', '>=', Carbon::now()->addDay())->get();

        foreach($loans as $loan) {
            $user = $loan->user;
            Mail::to($user->email)->send(new LoanMail($user));
        }
});

require __DIR__.'/auth.php';
