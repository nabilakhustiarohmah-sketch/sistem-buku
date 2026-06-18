<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        return 'Laravel berhasil berjalan';
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        Book::create($request->all());

        return redirect('/')
            ->with('success', 'Buku berhasil ditambahkan');
    }

    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $book->update($request->all());

        return redirect('/')
            ->with('success', 'Buku berhasil diupdate');
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return redirect('/')
            ->with('success', 'Buku berhasil dihapus');
    }
}