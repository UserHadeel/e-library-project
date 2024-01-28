<?php

namespace App\Http\Controllers;

use App\Models\ScientificJournals;
use App\Http\Requests\StoreScientificJournalsRequest;
use App\Http\Requests\UpdateScientificJournalsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ScientificJournalsController extends Controller
{
    function __construct()

    {

         $this->middleware('permission:قائمة-المجلات|انشاء-مجلة|تعديل-مجلة|حذف-مجلة', ['only' => ['index','show']]);

         $this->middleware('permission:انشاء-مجلة', ['only' => ['create','store']]);

         $this->middleware('permission:تعديل-مجلة', ['only' => ['edit','update']]);

         $this->middleware('permission:حذف-مجلة', ['only' => ['destroy']]);

    }
    public function index()
    {
        $scientificJournals = ScientificJournals::all();
        return view("scientificJournals.index", ['scientificJournals' => $scientificJournals]);
    }


    public function create()
    {
        //
    }


    public function store( Request $request)
    {
        $imageName = time().'.'.$request->image->extension();

        $validatedData = Validator::make($request->all(),
        [
            'title' => 'required|max:255',
            'publishing' => 'required|max:255',
            'Year_of_publication' => 'required|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            // 'resource' => 'required|mimes:pdf,xlx,csv|max:9390',
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
                    "result" => " فشلت عملية تعديل المجلة العلمية. السبب: امتداد الملف غير صحيح  ". "'".$resourceExt. "'",
                    "book" => null,
                ];
            }
            $resourceFileName = $request->file('resource');
            $resourceFullName = time().'_'.$resourceFileName->getClientOriginalName();
        }


        $file = $request->file('image');
        $filename = time().'_'.$file->getClientOriginalName();


        $scientificJournalsData = [
            'title' => $request->title,
            'publishing' =>  $request->publishing,
            'Year_of_publication' =>  $request->Year_of_publication,
            'image' => $filename,
            'resource' => $resourceFullName,
            'able_to_download'=>$request->has('able_to_download') ? true : false,
        ];
        $request->image->move(public_path('images/scientific_cover'), $filename);
        if($request->has('resource') && $resourceFullName != null)
            $request->resource->move(public_path('files/scientific_file'), $resourceFullName);

        ScientificJournals::create($scientificJournalsData);
        return [
            "result" => "تم إضافة المجلة العلمية بنجاح",
            "scientificJournals" => $scientificJournalsData,
            "image" => json_encode($request->file("image")),
            "hasfile" => json_encode($request->keys()),
            "resource"  => json_encode($request->file("resource")),
        ];}}


    public function show(ScientificJournals $scientificJournals)
    {
        return view('scientificJournals.show',compact('scientificJournals'));
    }


    public function edit( $id)
    {
        $scientificJournals = ScientificJournals::findorFail($id);
        return view("scientificJournals.edit",compact("scientificJournals"));
    }


    public function fetch_update(Request $request)
    {
        $scientificJournals = ScientificJournals::findorFail($request->id);

        $resourceFullName = null;
        if($request->has('resource')) {
            $resourceExt = $request->resource->extension();
            if($resourceExt != "pdf" && $resourceExt != "xlx"
            && $resourceExt != "docx" && $resourceExt != "pptx") {
                return [
                    "result" => " فشلت عملية تعديل المجلة العلمية. السبب: امتداد الملف غير صحيح  ". "'".$resourceExt. "'",
                    "book" => null,
                ];
            }
            $resourceFileName = $request->file('resource');
            $resourceFullName = time().'_'.$resourceFileName->getClientOriginalName();
        }

        $scientificJournalsData = [
            'title'=>$request->title,
            'publishing' =>  $request->publishing,
            'Year_of_publication' =>  $request->Year_of_publication,
            'resource' => $resourceFullName,
            'able_to_download' => $request->has('able_to_download') ? true : false
        ];
        $scientificJournals->update($scientificJournalsData);

        if($request->has('resource') && $resourceFullName != null)
            $request->resource->move(public_path('files/scientific_file'), $resourceFullName);
        $scientificJournalsData["id"] = $request->id;

        return [
            "result"=>"تم تعديل المجلة العلمية بنجاح",
            "scientificJournals"=>$scientificJournalsData ];
    }

    public function destroy($id)
    {

        ScientificJournals::destroy($id);
        return redirect()->route('scientificJournals.index')
        ->with('success','تم حذف المجلة العلمية بنجاح');
    }
    public function search(Request $request)
    {
        $query = ScientificJournals::query();

        if ($request->has('query')) {
            $queryValue = $request->input('query');
            $query->where(function ($q) use ($queryValue) {
                $q->where('title', 'like', "%$queryValue%")
                ->orWhere('publishing', 'like', "%$queryValue%")
                ->orWhere('Year_of_publication', 'like', "%$queryValue%");});}
        $scientificJournals = $query->get();
        return view('scientificJournals.index', compact('scientificJournals'));
    }
}
