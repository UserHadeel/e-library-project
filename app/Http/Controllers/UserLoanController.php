<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Models\Category;
use App\Models\department;
use App\Models\Loan;
use App\Models\projectLoan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator as ValidatorFacade;
use Illuminate\Validation\Validator;
use Illuminate\View\View;


class UserLoanController extends Controller
{
    function __construct()

    {
        $this->middleware('permission:قائمة-الاستعارة|انشاء-استعارة|تعديل-استعارة|', ['only' => ['index','show']]);

        $this->middleware('permission:انشاء-استعارة', ['only' => ['create','store']]);

        $this->middleware('permission:تعديل-استعارة', ['only' => ['edit','update']]);

        //  $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    public function index(): View
    {
       /**  @var \App\Models\User $user **/
        $user = Auth::user();
        $categories = Category::all();
        $department = department::all();

        if ($user->role === 'مسؤول') {
            $loans = Loan::all();
            $projectloan = projectLoan::all();

        } else {
            $loans = $user->activeLoans();
            $projectloan = $user->projectactiveLoans();

        }
        return view('userloans.index', ['projectloan'=>$projectloan,'loans' => $loans,'categories'=>$categories,'department'=>$department]);
    }

    public function store (Book $book, Request $request): RedirectResponse {

        $validator = ValidatorFacade::make($request->all(), [
            'number_borrowed' => 'required|int',
            'return_date'     => 'required',]);

        $validator->after(function (Validator $validator) use ($book) {
            $numberBorrowed = $validator->safe()->number_borrowed;
            $availablequantity = $book->availablequantity();
            if ($numberBorrowed > $availablequantity) {
                $validator->errors()->add(
                    'number_borrowed',
                    " عذراً ، لا يمكنك استعارة أكثر من  {$availablequantity} كتب"
                );}});

                if ($validator->fails()) {
                    return to_route('userloans.create', ['book' => $book])
                        ->withErrors($validator)
                        ->withInput();}
                $loanDetails = $validator->safe()->only([
                    'number_borrowed',
                    'return_date',]);


        $loanDetails['book_id'] = $book->id;
        $loanDetails['user_id'] = Auth::user()->id;
        $loanDetails['first_name']= $request->first_name;
        $loanDetails['last_name']= $request->last_name;
        $loanDetails['email']= $request->email;
        $loanDetails['phone']= $request->phone;

        Loan::create($loanDetails);

        return redirect()->route('userloans.index')
        ->with('success','تم عملية الاستعارة بنجاح');

    }


    public function create(Book $book): View {

        return view('userloans.create', ['book' => $book]);
    }

    public function terminate(Loan $loan) {
        $loan->terminate();
        return redirect()->route('userloans.index')
        ->with('success','تم عملية الارجاع بنجاح');

    }
}
