<?php

namespace App\Http\Controllers;

use App\Models\department;
use App\Http\Requests\StoredepartmentRequest;
use App\Http\Requests\UpdatedepartmentRequest;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{

    function __construct()

    {


    }
    public function index()
    {
        $department = Department::all();
        return view('department.index', compact('department'));
    }

    public function create()
    {
        return view('department.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|unique:departments,name',
    ]);

    Department::create([
        'name' => $request->input('name'),
    ]);

    return redirect()->route('department.index')->with('success', 'تم أضافة القسم بنجاح');
}

    public function edit(Department $department)
    {
        return view('department.edit', compact('department'));
    }



public function updated(Request $request,  $id)
{
    $department = Department::findorFail($id);
    $department->update([
        'name' => $request->input('name'),
    ]);

    return [
        "result"=>"تم تعديل بيانات القسم بنجاح",
        "department"=>$department ];
}

    public function show($departmentName)
{

    $department = Department::all();
    return view('department.show', compact('department'));
}

    public function destroy($id)
    {
        Department::findorFail($id)->delete();

        return redirect()->route('department.index');
    }
}
