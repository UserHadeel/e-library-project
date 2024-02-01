<?php


namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use App\Http\Controllers\Api\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use App\Models\GraduationProjects;


class A_GraduationProjectsController extends BaseController {

    public function index( Request $request)
    {
        $project = GraduationProjects::all();
        return $this->sendResponse($project,' return all GraduationProjects ');
    }
    function getProjects($dep_name){
        $project = GraduationProjects::where('dep_name','=',$dep_name)->get();
        return $this->sendResponse($project,'GraduationProjects return ');
    }
    public function searchProjects(Request $request)
    {
        $searchTerm = $request->input('search');

        $project = GraduationProjects::where('title', 'LIKE', '%' . $searchTerm . '%')
            ->orWhere('student_name', 'LIKE', '%' . $searchTerm . '%')
            ->orWhere('supervisor_name', 'LIKE', '%' . $searchTerm . '%')
            ->orWhere('year', 'LIKE', '%' . $searchTerm . '%')
            ->orWhere('dep_name', 'LIKE', '%' . $searchTerm . '%')
            ->get();

        return $this->sendResponse($project, 'Search results');
    }
}
