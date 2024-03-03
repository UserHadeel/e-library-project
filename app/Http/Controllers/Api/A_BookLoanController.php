<?php

namespace App\Http\Controllers\Api;
use App\Models\Loan;
use App\Models\User;
use App\Models\Book;
use App\Models\Category;
use App\Models\department;
use App\Models\projectLoan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator as ValidatorFacade;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Api\BaseController as BaseController;


class A_BookLoanController  extends BaseController
{
//   public function getBookLoans($user_id)
//  {
//    $loans = Loan::where('user_id','=',$user_id)->get();
//     // $loans = Loan::all();

//    return $this->sendResponse($loans,'Return book loans');

//  }

public function getBookLoans($user_id)
{
    $loans = Loan::where('user_id', '=', $user_id)
        ->with('book')
        ->where('is_returned', '=', 0)
        ->get();

    $bookLoans = [];
    foreach ($loans as $loan) {
        $bookLoans[] = [
            'book_name' => $loan->book->title,
            'return_date' => $loan->return_date, // استرداد حقل returnDate
        ];
    }

    return $this->sendResponse($bookLoans, 'Return book loans');
}
//  public function storeBookLoan(Request $request)
//  {
//      // التحقق من صحة البيانات
//      $validatedData = $request->validate([
//          'book_id' => 'required',
//          'user_id' => 'required',
//          'first_name' => 'required',
//          'last_name' => 'required',
//          'email' => 'required|email',
//          'phone' => 'required',
//          'return_date' => 'required|date',
//          'number_borrowed' => 'required|integer',
//      ]);

//      // حفظ البيانات في قاعدة البيانات
//      $loan = new Loan();
//      $loan->book_id = $validatedData['book_id'];
//      $loan->user_id = $validatedData['user_id'];
//      $loan->first_name = $validatedData['first_name'];
//      $loan->last_name = $validatedData['last_name'];
//      $loan->email = $validatedData['email'];
//      $loan->phone = $validatedData['phone'];
//      $loan->return_date = $validatedData['return_date'];
//      $loan->number_borrowed = $validatedData['number_borrowed'];

//      $loan->save();

//      return $this->sendResponse($loan,'saved Book loans');
//  }

public function storeBookLoan(Request $request)
{
    // التحقق من صحة البيانات
    $validatedData = $request->validate([
        'book_id' => 'required',
        'user_id' => 'required',
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'required|email',
        'phone' => 'required',
        'return_date' => 'required|date',
        'number_borrowed' => 'required|integer',
    ]);

    // التحقق من صحة رقم الكتاب ورقم المستخدم
    $book = Book::find($validatedData['book_id']);
    $user = User::find($validatedData['user_id']);

    if (!$book || !$user) {
        return response()->json(['message' => 'Invalid book or user.'], 400);
    }

    // حفظ البيانات في قاعدة البيانات
    $loan = new Loan();
    $loan->book_id = $validatedData['book_id'];
    $loan->user_id = $validatedData['user_id'];
    $loan->first_name = $validatedData['first_name'];
    $loan->last_name = $validatedData['last_name'];
    $loan->email = $validatedData['email'];
    $loan->phone = $validatedData['phone'];
    $loan->return_date = $validatedData['return_date'];
    $loan->number_borrowed = $validatedData['number_borrowed'];

    $loan->save();

    return $this->sendResponse($loan,'saved Book loans');

}

}
