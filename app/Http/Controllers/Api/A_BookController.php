<?php


namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use App\Http\Controllers\Api\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Book;
use App\Models\Loan;

class A_BookController extends BaseController {

    public function index( Request $request)
    {
        $books = Book::all();
        return $this->sendResponse($books,'book return all book ');
    }
    public function lastBook( Request $request)
    {
        $lastNewBooks =Book::latest()->take(10)->get(['id','title','cat_name','author','image','available_quantity','resource', 'able_to_borrow', 'able_to_download']);

        return $this->sendResponse($lastNewBooks,'book return all book ');
    }

    public function mostborrowed( Request $request)
    {
        $mostborrowed =Loan::selectRaw('book.title as TITLE, loans.book_id as ID, book.author as author, book.image as imagee, book.available_quantity as available_quantity, book.resource as resourcee, count(*) as LCOUNT')
        ->join('book', 'book.id', '=', 'loans.book_id')
        ->groupBy('loans.book_id')
        ->orderByDesc('LCOUNT')
        ->limit(10)
        ->get();
        return $this->sendResponse($mostborrowed,' return  mostborrowed book ');
    }
    function getBook($cat_name){
        $book = Book::where('cat_name','=',$cat_name)->get();
        return $this->sendResponse($book,'book return ');
    }

    public function searchBook(Request $request)
    {
        $searchTerm = $request->input('search');

        $books = Book::where('title', 'LIKE', '%' . $searchTerm . '%')
            ->orWhere('author', 'LIKE', '%' . $searchTerm . '%')
            ->orWhere('cat_name', 'LIKE', '%' . $searchTerm . '%')
            ->orWhere('serial_number', 'LIKE', '%' . $searchTerm . '%')
            ->orWhere('publisher', 'LIKE', '%' . $searchTerm . '%')
            ->get();

        return $this->sendResponse($books, 'Search results');
    }

//     public function getImage($id)
// {
//     $book = Book::findOrFail($id);
//     $imagePath = $book->image;

//     if ($imagePath) {
//         $file = Storage::disk('public')->get('images/book_cover/' . $imagePath);
//         return response($file, 200, ['Content-Type' => 'image/jpeg']);
//     }

//     return response()->json(['error' => 'Image not found'], 404);
// }
    public function downloadPdf($id)
    {
        $book = Book::find($id);

        if (!$book) {
           return $this->sendError('هذا الكتاب غير موجود');
        }

        $filePath = public_path('public/files/book_file/' . $book->resource);

        if (!file_exists($filePath)){
           return $this->sendError('ملف هذا الكتاب غير متوفر');
        }
           return $this->sendResponse($filePath, 'download');

}

}
