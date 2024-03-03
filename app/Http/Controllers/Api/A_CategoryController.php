<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Models\Category;

class A_CategoryController extends BaseController {

    public function index( Request $request)
    {
        $categories = Category::all();
        return $this->sendResponse($categories,'categories return all book ');
    }


}
