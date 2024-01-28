<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Requests\UpdateBookRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("book.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function addBook()
    {
        return view("book.add-book");

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : RedirectResponse
    {
        Book::create([
            'title'=>$request->title,
            'author'=>$request->author,
            'publisher'=>$request->publisher,
            'serial_number'=>$request->serial_number,
            'available_quantity'=>$request->available_quantity,
            'description'=>$request->description
        ]);
           return Redirect::to("/book");

    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        //
    }
}
