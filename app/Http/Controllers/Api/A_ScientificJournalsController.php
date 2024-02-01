<?php


namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use App\Http\Controllers\Api\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use App\Models\ScientificJournals;

class A_ScientificJournalsController extends BaseController {

    public function index( Request $request)
    {
        $Journals = ScientificJournals::all();
        return $this->sendResponse($Journals,' return all ScientificJournals ');
    }

    public function searchJournals(Request $request)
    {
        $searchTerm = $request->input('search');

        $Journals = ScientificJournals::where('title', 'LIKE', '%' . $searchTerm . '%')
            ->orWhere('publishing', 'LIKE', '%' . $searchTerm . '%')
            ->orWhere('Year_of_publication', 'LIKE', '%' . $searchTerm . '%')
            ->get();
        return $this->sendResponse($Journals, 'Search results');
    }
}
