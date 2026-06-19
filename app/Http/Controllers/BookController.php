<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function index()
    {
        try {
            // Hitung jumlah buku di tabel books
            $count = DB::table('books')->count();

            // Ambil semua data buku
            $books = Book::all();

            // Kirim ke view index
            return view('books.index', compact('books', 'count'));
        } catch (\Exception $e) {
            // Kalau ada error, tampilkan pesan
            return "Database error: " . $e->getMessage();
        }
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
