<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\department;
use App\Models\GraduationProjects;
use App\Models\ScientificJournals;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainPageController extends Controller
{
    public function index(Request $request)
    {
        $books = Book::all();
        return view("bookPage.mainPage", ['books' => $books, 'categories' => Category::all(),'department' => department::all()]);
    }

    public function search(Request $request)
{
    $query = null;
    $num=6;
    $i = $request->type ?? "book";

    // you alreadu have 'title', 'qeury' = button, and 'type' = the hidden guy..
    // so we don't have to check if it does exist any more!
    // and since we need to make our search more confienent we can do :
    $queryValue = $request->input('query');

    if($i == "book") {
        $query = Book::query();

        $query->where(function ($q) use ($queryValue) {
            $q->where('title', 'like', "%$queryValue%")
                ->orWhere('cat_name', 'like', "%$queryValue%")
                ->orWhere('serial_number', 'like', "%$queryValue%")
                ->orWhere('author', 'like', "%$queryValue%");
        });
    } else {
        $query = GraduationProjects::query();
        $query->where(function ($q) use ($queryValue) {
            $q->where('title', 'like', "%$queryValue%")
                ->orWhere('dep_name', 'like', "%$queryValue%")
                ->orWhere('supervisor_name', 'like', "%$queryValue%")
                ->orWhere('year', 'like', "%$queryValue%")
                ->orWhere('student_name', 'like', "%$queryValue%");
        });
    }
    $books = $query->paginate($num);
    $categories = Category::all();
    $department = department::all();
    $itemsShowing=  (is_null($i) ? "book" : $i == 'book') ? 'book' : 'gp';

    return view('bookPage.mainPage', compact('books', 'categories','department','itemsShowing'));
}


// function old_search($request) {
//     $query = Book::query();
//     $num=6;
//     $i = 'book' ? 'book' : 'gp';

//     if ($request->has('title')) {
//         $title = $request->input('title');
//         $query->where('title', 'like', "%$title%");
//     }

//     if ($request->has('cat_name')) {
//         $catName = $request->input('cat_name');
//         $query->where('cat_name', $catName);
//     }

//     if ($request->has('author')) {
//         $author = $request->input('author');
//         $query->where('author', 'like', "%$author%");
//     }

//     if ($request->has('query')) {
//         $queryValue = $request->input('query');
//         $query->where(function ($q) use ($queryValue) {
//             $q->where('title', 'like', "%$queryValue%")
//                 ->orWhere('cat_name', 'like', "%$queryValue%")
//                 ->orWhere('author', 'like', "%$queryValue%");
//         });
//     }

//     $Pquery = DB::table('graduation_projects');

//     if ($request->has('Pquery')) {
//         $queryValue = $request->input('Pquery');
//         $Pquery->where(function ($Pquery) use ($queryValue) {
//             $Pquery->where('title', 'like', "%$queryValue%")
//                 ->orWhere('student_name', 'like', "%$queryValue%")
//                 ->orWhere('supervisor_name', 'like', "%$queryValue%")
//                 ->orWhere('year', 'like', "%$queryValue%")
//                 ->orWhere('dep_name', 'like', "%$queryValue%");
//         });
//     }
//     $Projects = $Pquery->paginate($num);


//     $books = $query->paginate($num);
//     $categories = Category::all();
//     $department = department::all();
//     $itemsShowing=  is_null($i) || $i == 'book' ? 'book' : 'gp';

//     return view('bookPage.mainPage', compact('books', 'categories','department','itemsShowing','Projects'));
// }

public function JournalsSearch(Request $request)
{
    $query = ScientificJournals::query();
    $num=6;
        if ($request->has('query')) {
            $queryValue = $request->input('query');
            $query->where(function ($q) use ($queryValue) {
                $q->where('title', 'like', "%$queryValue%")
                ->orWhere('publishing', 'like', "%$queryValue%")
                ->orWhere('Year_of_publication', 'like', "%$queryValue%");});}

        $scientificJournals = $query->get();
        $books = $query->paginate($num);
        $categories = Category::all();
        $department = department::all();
        return view('scientificJournalsPage.index', compact('scientificJournals','books', 'categories','department'));
    }

}

