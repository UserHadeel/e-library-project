<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Models\Category;
use App\Models\department;
use App\Models\Loan;
use App\Models\projectLoan;
use App\Models\User;
use App\Notifications\create_loan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
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

        // $user=User::where('id','=','1')->get();
        // $user_create =auth()->user()->name;
        // Notification::send($user,new create_loan($user_create));
        //  return redirect()->route('userloans.index')
        //  ->with('success','Book borrowed successfully');
        return redirect()->route('userloans.index')
        ->with('success','تم عملية الاستعارة بنجاح');
        // return view('userloans.index')->with('success','Book returned successfully');
        }


    public function create(Book $book): View {

        return view('userloans.create', ['book' => $book]);
    }

    public function terminate(Loan $loan) {
        $loan->terminate();
        return redirect()->route('userloans.index')
        ->with('success','تم عملية الارجاع بنجاح');
            // return redirect()->route('userloans.index')
            // ->with('success','Book returned successfully');
            // return view('userloans.index')->with('success','Book returned successfully');
           // return Redirect::to("/loans.index")->withSuccess('Success message');
    }


     // public function store (Book $book, Request $request): string {
    //     Log::channel('stderr')->info('Something happened!>-----------------------------------');
    //     $currentDate = now();
    //     $currentDate->day($currentDate->day+14);
    //     $validator = ValidatorFacade::make($request->all(), [
    //         'number_borrowed' => ['required','int'],
    //         'return_date'     => ['required','date','before:'.$currentDate->month.'/'.$currentDate->day.'/'.$currentDate->year, 'after:'.now()->month.'/'.now()->day.'/'.now()->year],
    //     ]);
    //     Log::channel('stderr')->info('Something happened!>>-----------------------------------');
    //     //ob_start();
    //     //var_dump($_POST);

    //     $validator->after(function (Validator $validator) use ($book) {
    //         $numberBorrowed = $validator->safe()->number_borrowed;
    //         $availablequantity = $book->availablequantity();
    //         if ($numberBorrowed > $availablequantity) {
    //             $validator->errors()->add(
    //                 'number_borrowed',
    //                 " عذراً ، لا يمكنك استعارة أكثر من  {$availablequantity} كتب"
    //             );}});
    //     Log::channel('stderr')->info('Something happened!>>>-----------------------------------');
    //     if($validator->errors()->count() > 0) {
    //         Log::channel('stderr')->info('Something happened! ERRRRRROR-------------------------');
    //     }
    //     // if ($validator->fails()) {
    //     //     Log::channel('stderr')->info('Something happened!-----------------------------------');
    //     //     Log::channel('stderr')->info('Some MF error occurred');

    //     //     return "Error";
    //     //     // return to_route('userloans.create', ['book' => $book])
    //     //     //     ->withErrors($validator)
    //     //     //     ->withInput();
    //     // }
    //     Log::channel('stderr')->info('Something happened!>>>>-----------------------------------');
    //     $loanDetails = $validator->safe()->only([
    //         'number_borrowed',
    //         'return_date',]);


    //     $loanDetails['book_id'] = $book->id;
    //     $loanDetails['user_id'] = Auth::user()->id;
    //     $loanDetails['first_name']= $request->first_name;
    //     $loanDetails['last_name']= $request->last_name;
    //     $loanDetails['email']= $request->email;
    //     $loanDetails['phone']= $request->phone;
    //     Log::channel('stderr')->info('Code reached this point <<<<<<<<<<<<<<<<<<<<<<<<<<<<<');
    //     Loan::create($loanDetails);

    //     // $user=User::where('id','=','1')->get();
    //     // $user_create =auth()->user()->name;
    //     // Notification::send($user,new create_loan($user_create));
    //     //  return redirect()->route('userloans.index')
    //     //  ->with('success','Book borrowed successfully');
    //     return "OK";
    //     // return redirect()->route('userloans.index')
    //     // ->with('successF','تم عملية الاستعارة بنجاح');
    //     // return view('userloans.index')->with('success','Book returned successfully');
    //     }
}
