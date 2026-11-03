<?php

namespace Modules\Library\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Modules\Library\Exceptions\BookNotAvailableException;
use Modules\Library\Models\Author;
use Modules\Library\Models\Book;
use Modules\Library\Requests\StoreBookRequest;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('author')->paginate(10);

        return view('books.index', compact('books'));
    }

    public function create()
    {
        $authors = Author::orderBy('name')->get();

        return view('books.create', compact('authors'));
    }

    public function store(StoreBookRequest $request)
    {
        Book::create($request->validated());

        return redirect()
            ->route('books.index')
            ->with('success', 'Buku berhasil ditambahkan.');
    }

    public function borrow(Book $book)
    {
        if ($book->stock < 1) {
            Log::warning('Peminjaman gagal, stok 0', ['book_id' => $book->id]);
            throw new BookNotAvailableException($book->title);
        }

        $book->decrement('stock');

        return back()->with('success', 'Buku berhasil dipinjam.');
    }
}
