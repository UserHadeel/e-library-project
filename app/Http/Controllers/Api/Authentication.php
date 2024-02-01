<?php


namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use App\Http\Controllers\Api\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;


class Authentication extends BaseController {

    function login(Request $request){
        if(Auth::attempt(['email' => $request->email, 'password' =>  $request->password])){
           return $this->sendResponse(Auth::user(),'login is ok');
        }else{
            return $this->sendError('login is not ok');
        }
    }
}
