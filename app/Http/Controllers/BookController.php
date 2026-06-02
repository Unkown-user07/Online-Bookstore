<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        return view('books.index', ['books' => Book::latest()->get()]);
    }

    public function apiIndex()
    {
        $books = Book::latest()->get();
        return response()->json($books, 200);
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'     => 'required|string|max:255',
            'author'    => 'required|string|max:255',
            'price'     => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image_url' => 'nullable|url',
        ]);

        Book::create($request->only('title', 'author', 'price', 'description', 'image_url'));

        return redirect('/')->with('success', 'Book added successfully.');
    }

    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title'     => 'required|string|max:255',
            'author'    => 'required|string|max:255',
            'price'     => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image_url' => 'nullable|url',
        ]);

        $book->update($request->only('title', 'author', 'price', 'description', 'image_url'));

        return redirect('/')->with('success', 'Book updated successfully.');
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return redirect('/')->with('success', 'Book deleted.');
    }
}
