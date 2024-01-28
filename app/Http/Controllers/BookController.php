<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;

use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{

    function __construct()

    {

         $this->middleware('permission:قائمة-الكتب|انشاء-كتاب|تعديل-كتاب|حذف-كتاب', ['only' => ['index','show']]);

         $this->middleware('permission:انشاء-كتاب', ['only' => ['create','store']]);

         $this->middleware('permission:تعديل-كتاب', ['only' => ['edit','update']]);

         $this->middleware('permission:حذف-كتاب', ['only' => ['destroy']]);

    }
    public function index(Request $request)
    {
        $books = Book::all();
        return view("book.index", ['books' => $books, 'categories' => Category::all()]);
    }


    public function create(Request $request)
    {
        return view("book.add-book");
    }


public function store(Request $request)
{
    $imageName = time().'.'.$request->image->extension();


        $validatedData = Validator::make($request->all(),
        [
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'publisher' => 'required|max:255',
            'description' => 'required|max:255',
            'serial_number' => 'required|max:255',
            'available_quantity' => 'required',
            'cat_name' => 'required|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            //'resource' => 'required|mimes:pdf,xlx,csv|max:2048',
        ]);

    if($validatedData->fails()) {

        return redirect()->back()->withErrors($validatedData)->withInput();
    } else {
        $resourceFullName = null;
        if($request->has('resource')) {
            $resourceExt = $request->resource->extension();
            if($resourceExt != "pdf" && $resourceExt != "xlx"
            && $resourceExt != "docx" && $resourceExt != "pptx") {
                return [
                    "result" => " فشلت عملية تسجيل  الكتاب. السبب: امتداد الملف غير صحيح  ". "'".$resourceExt. "'",
                    "book" => null,
                ];
            }
            $resourceFileName = $request->file('resource');
            $resourceFullName = time().'_'.$resourceFileName->getClientOriginalName();
        }

        $file = $request->file('image');
        $filename = time().'_'.$file->getClientOriginalName();



        $bookData = [
            'title' => $request->title,
            'author' => $request->author,
            'publisher' => $request->publisher,
            'description' => $request->description,
            'serial_number' => $request->serial_number,
            'available_quantity' => $request->available_quantity,
            'cat_name' => $request->cat_name,
            'image' => $filename,
            'resource' => $resourceFullName,
            'able_to_borrow'=>$request->has('able_to_borrow') ? true : false,
            'able_to_download'=>$request->has('able_to_download') ? true : false,
        ];
        $request->image->move(public_path('images/book_cover'), $filename);
        if($request->has('resource') && $resourceFullName != null)
            $request->resource->move(public_path('files/book_file'), $resourceFullName);

        Book::create($bookData);
        return [
            "result" => "تم إضافة الكتاب بنجاح",
            "book" => $bookData,
            "image" => json_encode($request->file("image")),
            "hasfile" => json_encode($request->keys()),
            "resource"  => json_encode($request->file("resource")),
        ];
    }
    }

    public function show(Book $book)

    {
        return view('book.show',compact('book'));

    }


    public function edit( $id)
    {
        $book = Book::findorFail($id);
        return view("book.edit-book",compact("book"));
    }


    public function fetch_update(Request $request)
    {
        $book = Book::findorFail($request->id);

        $resourceFullName = null;
        if($request->has('resource')) {
            $resourceExt = $request->resource->extension();
            if($resourceExt != "pdf" && $resourceExt != "xlx"
            && $resourceExt != "docx" && $resourceExt != "pptx") {
                return [
                    "result" => " فشلت عملية تعديل الكتاب. السبب: امتداد الملف غير صحيح  ". "'".$resourceExt. "'",
                    "book" => null,
                ];
            }
            $resourceFileName = $request->file('resource');
            $resourceFullName = time().'_'.$resourceFileName->getClientOriginalName();
        }

        $bookData = [
            'title'=>$request->title,
            'author'=>$request->author,
            'publisher'=>$request->publisher,
            'serial_number'=>$request->serial_number,
            'description'=>$request->description,
            'available_quantity'=>$request->available_quantity,
            'cat_name'=>$request->cat_name,
            'resource' => $resourceFullName,
            'able_to_borrow' =>$request->has('able_to_borrow') ? true : false,
            'able_to_download' => $request->has('able_to_download') ? true : false
        ];

        $book->update($bookData);

        if($request->has('resource') && $resourceFullName != null)
            $request->resource->move(public_path('files/book_file'), $resourceFullName);

        $bookData["id"] = $request->id;
        return [
            "result"=>"تم تعديل الكتاب بنجاح",
            "book"=>$bookData ];
    }

    public function update(Request $request, $id)
    {
        $book = Book::findorFail($id);
        $book->update([
            'title'=>$request->title,
            'author'=>$request->author,
            'publisher'=>$request->publisher,
            'serial_number'=>$request->serial_number,
            'description'=>$request->description,
            'available_quantity'=>$request->available_quantity,
            'cat_name'=>$request->category_name
        ]);

        return redirect()->route('book.index');

    }

    public function destroy($id)
    {
        $book = Book::find($id);

        if ($book->hasActiveLoan()) {
            return redirect()->route('book.index')
                ->with('error', 'لا يمكن حذف الكتاب لوجود استعارة نشطة عليه');
        }

        $book->delete();

        return redirect()->route('book.index')
        ->with('success', 'تم حذف الكتاب بنجاح');
}



public function search(Request $request)
{
    $query = Book::query();


    if ($request->has('query')) {
        $queryValue = $request->input('query');
        $query->where(function ($q) use ($queryValue) {
            $q->where('title', 'like', "%$queryValue%")
                ->orWhere('cat_name', 'like', "%$queryValue%")
                ->orWhere('serial_number', 'like', "%$queryValue%")
                ->orWhere('author', 'like', "%$queryValue%")
                ->orWhere('publisher', 'like', "%$queryValue%")
                ->orWhere('available_quantity', 'like', "%$queryValue%");
        });
    }

    $books = $query->get();
    $categories = Category::all();

    return view('book.index', compact('books', 'categories'));
}

}
