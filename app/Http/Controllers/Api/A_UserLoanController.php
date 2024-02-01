<?php

namespace App\Http\Controllers\Api;
use App\Models\Loan;
use App\Models\User;
use App\Models\Category;
use App\Models\department;
use App\Models\projectLoan;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Api\BaseController as BaseController;


class A_UserLoanController  extends BaseController
{
  public function getUserLoans($user_id)
 {
   $loans = Loan::where('user_id','=',$user_id)->get();
   
   return $this->sendResponse($loans,'Return user loans');

 }
}
