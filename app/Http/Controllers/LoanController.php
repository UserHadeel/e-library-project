<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Models\Loan;
use App\Models\projectLoan;
use App\Models\User;
use App\Notifications\create_loan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator as ValidatorFacade;
use Illuminate\Validation\Validator;
use Illuminate\View\View;


class LoanController extends Controller
{
    function __construct()

    {
        $this->middleware('permission:قائمة-الاستعارة|انشاء-استعارة|تعديل-استعارة|', ['only' => ['index','show']]);

        $this->middleware('permission:انشاء-استعارة', ['only' => ['create','store']]);

        $this->middleware('permission:تعديل-استعارة', ['only' => ['edit','update']]);
    }


    public function index(): View
    {
        /** @var \App\Models\User $user **/
        $user = Auth::user();

        if ($user->role === 'مسؤول') {
            $loans = Loan::where('is_returned', 0)->get();
            $projectloan =projectLoan ::where('is_returned', 0)->get();
        } else {
            $loans = $user->activeLoans();
            $projectloan = $user->projectactiveLoans();
        }
        return view('loans.index', ['projectloan'=>$projectloan,'loans' => $loans]);
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
                    // "You cannot borrow more than {$availablequantity} book(s)"
            );}});

            if ($validator->fails()) {
                return to_route('loans.create', ['book' => $book])
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

        $user=User::where('id','=','1')->get();
        $user_create =auth()->user()->name;
        Notification::send($user,new create_loan($user_create));

        return redirect()->route('loans.index')
        ->with('success','تم عملية الاستعارة بنجاح');
        }


    public function create(Book $book): View {
        return view('loans.create', ['book' => $book]);
    }


    public function terminate(Loan $loan): RedirectResponse {
        $loan->terminate();
            return redirect()->route('loans.index')
            ->with('success','تم عملية الارجاع بنجاح');
        // return Redirect::to("/loans.index")->withSuccess('Success message');
    }

}
