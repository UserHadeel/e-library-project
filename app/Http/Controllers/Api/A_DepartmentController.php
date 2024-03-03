<?php

namespace App\Http\Controllers\Api;

use App\Models\department;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;

class A_DepartmentController extends BaseController {

    public function index( Request $request)
    {
        $department = department::all();
        return $this->sendResponse($department,'department return ');
    }


}
