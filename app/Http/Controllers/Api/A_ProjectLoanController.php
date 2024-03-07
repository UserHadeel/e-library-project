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
use App\Http\Controllers\Api\BaseController as BaseController;


class A_ProjectLoanController  extends BaseController
{
    public function getProjectLoans($user_id)
    {
        $loans = projectLoan::where('user_id', '=', $user_id)
            ->with('graduation_projects')
            ->where('is_returned', '=', 0)
            ->get();

        $projectLoans = [];
        foreach ($loans as $loan) {
            $projectLoans[] = [
                'project_name' => $loan->graduation_projects->title,
                'return_date' => $loan->return_date, // استرداد حقل returnDate
            ];
        }

        return $this->sendResponse($projectLoans, 'Return book loans');
    }

    //   public function getProjectLoans($user_id)
    //  {
    //    $loans = projectLoan::where('user_id','=',$user_id)->get();

    //    return $this->sendResponse($loans,'Return project loans');

    //  }

    public function storeProjectLoan(Request $request)
    {
        // التحقق من صحة البيانات
        $validatedData = $request->validate([
            'graduation_projects_id' => 'required',
            'user_id' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'return_date' => 'required|date',
            'number_borrowed' => 'required|integer',
        ]);

        // حفظ البيانات في قاعدة البيانات
        $loan = new projectLoan();
        $loan->graduation_projects_id = $validatedData['graduation_projects_id'];
        $loan->user_id = $validatedData['user_id'];
        $loan->first_name = $validatedData['first_name'];
        $loan->last_name = $validatedData['last_name'];
        $loan->email = $validatedData['email'];
        $loan->phone = $validatedData['phone'];
        $loan->return_date = $validatedData['return_date'];
        $loan->number_borrowed = $validatedData['number_borrowed'];
        $loan->save();


        return $this->sendResponse($loan, 'saved Book loans');
    }
}
// (Book $book, Request $request): JsonResponse
// {
//     $validator = ValidatorFacade::make($request->all(), [
//         'number_borrowed' => 'required|int',
//         'return_date'     => 'required',
//     ]);

//     $validator->after(function (Validator $validator) use ($book) {
//         $numberBorrowed = $validator->safe()->number_borrowed;
//         $availablequantity = $book->availablequantity();
//         if ($numberBorrowed > $availablequantity) {
//             $validator->errors()->add(
//                 'number_borrowed',
//                 " عذراً ، لا يمكنك استعارة أكثر من  {$availablequantity} كتب"
//             );
//         }
//     });

//     if ($validator->fails()) {
//         return response()->json([
//             'message' => 'خطأ في البيانات المدخلة',
//             'errors' => $validator->errors(),
//         ], 422);
//     }

//     $loanDetails = $validator->safe()->only([
//         'number_borrowed',
//         'return_date',
//     ]);

//     $loanDetails['book_id'] = $book->id;
//     $loanDetails['user_id'] = Auth::user()->id;
//     $loanDetails['first_name'] = $request->first_name;
//     $loanDetails['last_name'] = $request->last_name;
//     $loanDetails['email'] = $request->email;
//     $loanDetails['phone'] = $request->phone;

//     Loan::create($loanDetails);
//     return $this->sendResponse($loanDetails,'Return user loans');

//     // return redirect()->route('userloans.index')
//     // ->with('success','تم عملية الاستعارة بنجاح');
//     }

// }
