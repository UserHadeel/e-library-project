<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    function __construct()

    {

         $this->middleware('permission:قائمة-اقسام-الكتب|انشاء-قسم-كتب|تعديل-قسم-كتب|حذف-قسم-كتب',  ['only' => ['index','show']]);

         $this->middleware('permission:انشاء-قسم-كتب', ['only' => ['create','store']]);

         $this->middleware('permission:تعديل-قسم-كتب', ['only' => ['edit','update']]);

         $this->middleware('permission:حذف-قسم-كتب', ['only' => ['destroy']]);

    }
    public function index()
    {
        $categories = Category::all();
        return view('category.index', compact('categories'));
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|unique:categories,name',
    ]);

    Category::create([
        'name' => $request->input('name'),
    ]);

    return redirect()->route('category.index')->with('success', 'تم أضافة القسم بنجاح');
}

    public function edit(Category $category)
    {
        return view('category.edit', compact('category'));
    }

    // public function update(Request $request, Category $id)
    // {
    //     $category = Category::findorFail($id);
    //     $category->update([
    //         'name'=>$request->name,

    //     ]);

    //     return redirect()->route('category.index');
    // }

public function update(Request $request,  $id)
{
    $category = Category::findorFail($id);
    $category->update([
        'name' => $request->input('name'),
    ]);

    return [
        "result"=>"تم تعديل بيانات القسم بنجاح",
        "categories"=>$category ];
}

    // public function show($categoryName)
    // {
    //     // $category = Category::with('books')->findOrFail($categoryName);
    //     // $books = $category->books;
    //     $category = Category::all();
    //     return view('Category.show', compact('category'));
    // }
    public function show($categoryName)
{
    // $category = Category::with('books')->findOrFail($categoryName);
    // $books = $category->books;
    $categories = Category::all();
    return view('category.show', compact('categories'));
}

    public function destroy($id)
    {
        Category::findorFail($id)->delete();
        // Category::destroy($id);
        return redirect()->route('category.index');
    }
}
