<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;


class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
    return view('books.index', [
        'books' => Book::all()
    ]);
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'title' => 'required',
        'author' => 'required',
        'isbn' => 'required|unique:books',
        'quantity' => 'required|integer|min:0',
    ]);

    Book::create($request->all());

    return redirect()->route('books.index');
}



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
{
    return view('books.edit', compact('book'));
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
{
    $request->validate([
        'title' => 'required',
        'author' => 'required',
        'isbn' => 'required',
        'quantity' => 'required|integer|min:0',
    ]);

    $book->update($request->all());

    return redirect()->route('books.index');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
{
    $book->delete();
    return redirect()->route('books.index');
}

}
