<?php

namespace App\Http\Controllers;

use App\Models\department;
use App\Models\GraduationProjects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class GraduationProjectsController extends Controller
{

    function __construct()

    {

         $this->middleware('permission:قائمة-المشاريع|اضافة-المشاريع|تعديل-المشاريع|حذف-المشاريع', ['only' => ['index','show']]);

         $this->middleware('permission:اضافة-المشاريع', ['only' => ['create','store']]);

         $this->middleware('permission:تعديل-المشاريع', ['only' => ['edit','update']]);

         $this->middleware('permission:حذف-المشاريع', ['only' => ['destroy']]);

    }
    public function index()
    {

        $Projects = GraduationProjects::all();
        return view("GraduationProjects.index", ['Projects' => $Projects, 'department' => department::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view("GraduationProjects.add-Project");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)

    {
        $imageName = time().'.'.$request->image->extension();

        $validatedData = Validator::make($request->all(),
        [
            'title' => 'required|max:255',
            'student_name' => 'required|max:255',
            'supervisor_name' => 'required|max:255',
            'year' => 'required',
            'dep_name' => 'required|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'available_quantity' => 'required',
            // 'resource' => 'required|mimes:pdf,xlx,csv|max:9392',
            ]);


    if($validatedData->fails()) {

        return redirect()->back()->withErrors($validatedData)->withInput();
    } else {
        $resourceFullName = null;
        if($request->has('resource')) {
            $resourceExt = $request->resource->extension();
            if($resourceExt != "pdf" && $resourceExt != "xlx"
            && $resourceExt != "docx" && $resourceExt != "pptx") {
                return [
                    "result" => " فشلت عملية تسجيل مشروع التخرج. السبب: امتداد الملف غير صحيح  ". "'".$resourceExt. "'",
                    "book" => null,
                ];
            }
            $resourceFileName = $request->file('resource');
            $resourceFullName = time().'_'.$resourceFileName->getClientOriginalName();
        }

        $file = $request->file('image');
        $filename = time().'_'.$file->getClientOriginalName();

        $projectData = [
            'title' => $request->title,
            'student_name' => $request->student_name,
            'supervisor_name' => $request->supervisor_name,
            'year' => $request->year,
            'dep_name' => $request->dep_name,
            'available_quantity' => $request->available_quantity,
            'image' => $filename,
            'resource' => $resourceFullName,
            'able_to_borrow'=>$request->has('able_to_borrow') ? true : false,
            'able_to_download'=>$request->has('able_to_download') ? true : false,
        ];
        $request->image->move(public_path('images/project_cover'), $filename);
        if($request->has('resource') && $resourceFullName != null)
            $request->resource->move(public_path('files/project_file'), $resourceFullName);

        GraduationProjects::create($projectData);
        return [
            "result" => "تم إضافة مشروع التخرج بنجاح",
            "book" => $projectData,
            "image" => json_encode($request->file("image")),
            "hasfile" => json_encode($request->keys()),
            "resource"  => json_encode($request->file("resource")),
        ];
    }
    }


    public function edit( $id)
    {
        $project = GraduationProjects::findorFail($id);
        return view("GraduationProjects.edit-project",compact("project"));
    }



    /**
     * Update the specified resource in storage.
     */

    public function fetch_update(Request $request)
    {
        $project = GraduationProjects::findorFail($request->id);

        $resourceFullName = null;
        if($request->has('resource')) {
            $resourceExt = $request->resource->extension();
            if($resourceExt != "pdf" && $resourceExt != "xlx"
            && $resourceExt != "docx" && $resourceExt != "pptx") {
                return [
                    "result" => " فشلت عملية تعديل مشروع التخرج. السبب: امتداد الملف غير صحيح  ". "'".$resourceExt. "'",
                    "book" => null,
                ];
            }
            $resourceFileName = $request->file('resource');
            $resourceFullName = time().'_'.$resourceFileName->getClientOriginalName();
        }

        $projectData = [
            'title'=>$request->title,
            'student_name'=>$request->student_name,
            'supervisor_name'=>$request->supervisor_name,
            'year'=>$request->year,
            'dep_name'=>$request->dep_name,
            'available_quantity'=>$request->available_quantity,
            'resource' => $resourceFullName,
            'able_to_borrow' =>$request->has('able_to_borrow') ? true : false,
            'able_to_download' => $request->has('able_to_download') ? true : false

        ];

        $project->update($projectData);

        if($request->has('resource') && $resourceFullName != null)
        $request->resource->move(public_path('files/project_file'), $resourceFullName);

        $projectData["id"] = $request->id;
        return [
            "result" => "تم تعديل المشروع بنجاح",
            "project" => $projectData
        ];
    }


    public function destroy($id)
    {

     GraduationProjects::destroy($id);

            return redirect()->route('GraduationProjects.index')
            ->with('success','تم حذف المشروع بنجاح');
}

    public function search(Request $request)
    {
    $query = DB::table('graduation_projects');

    if ($request->has('query')) {
        $queryValue = $request->input('query');
        $query->where(function ($query) use ($queryValue) {
            $query->where('title', 'like', "%$queryValue%")
                ->orWhere('student_name', 'like', "%$queryValue%")
                ->orWhere('supervisor_name', 'like', "%$queryValue%")
                ->orWhere('year', 'like', "%$queryValue%")
                ->orWhere('dep_name', 'like', "%$queryValue%");
        });
    }

    $Projects = $query->get();
    $department = department::all();

    return view('GraduationProjects.index', compact('Projects','department'));
}
}
