<?php

namespace App\Http\Controllers;

use App\Models\projectLoan;
use App\Http\Requests\StoreprojectLoanRequest;
use App\Http\Requests\UpdateprojectLoanRequest;
use App\Models\GraduationProjects;
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


class ProjectLoanController extends Controller
{
    function __construct()

    {

        $this->middleware('permission:قائمة-استعارات-المشاريع|انشاء-استعارة-مشروع|تعديل-استعارة-مشروع|', ['only' => ['index','show']]);

        $this->middleware('permission:انشاء-استعارة-مشروع', ['only' => ['create','store']]);

        $this->middleware('permission:تعديل-استعارة-مشروع', ['only' => ['edit','update']]);



    }



    public function index(): View
    {
        /** @var \App\Models\User $user **/
        $user = Auth::user();

        if ($user->role === 'مسؤول') {
            $projectloan = projectLoan::where('is_returned', 0)->get();
        } else {
            $projectloan = $user->projectactiveLoans();
        }

        return view('projectloans.index', ['projectloan' => $projectloan]);
    }

    public function store (GraduationProjects $project, Request $request): RedirectResponse {
        $validator = ValidatorFacade::make($request->all(), [
            'number_borrowed' => 'required|int',
            'return_date'     => 'required',]);

    $validator->after(function (Validator $validator) use ($project) {
            $numberBorrowed = $validator->safe()->number_borrowed;
            $availablequantity = $project->availablequantity();
            if ($numberBorrowed > $availablequantity) {
                $validator->errors()->add(
                    'number_borrowed',
                   " كتب {$availablequantity}لايمكنك استعارة اكثر من"
                    // "You cannot borrow more than {$availablequantity} book(s)"
                );}});

        if ($validator->fails()) {
            return to_route('projectloans.create', ['project' => $project])
                ->withErrors($validator)
                ->withInput();}
        $projectloanDetails = $validator->safe()->only([
            'number_borrowed',
            'return_date',]);

        $projectloanDetails['graduation_projects_id'] = $project->id;
        $projectloanDetails['user_id'] = Auth::user()->id;
        $projectloanDetails['first_name']= $request->first_name;
        $projectloanDetails['last_name']= $request->last_name;
        $projectloanDetails['email']= $request->email;
        $projectloanDetails['phone']= $request->phone;

        projectLoan::create($projectloanDetails);


        $user=User::where('id','=','1')->get();
        $user_create =auth()->user()->name;
        Notification::send($user,new create_loan($user_create));


         return redirect()->route('userloans.index')
         ->with('success','تم عملية الاستعارة بنجاح');
        }


    public function create(GraduationProjects $project): View {
        return view('projectloans.create', ['project' => $project]);
    }


    public function terminate(projectLoan $projectLoan): RedirectResponse {
        $projectLoan->terminate();
            return redirect()->route('projectloans.index')
            ->with('success','تم عملية الارجاع بنجاح');
        // return Redirect::to("/loans.index")->withSuccess('Success message');
    }
}
