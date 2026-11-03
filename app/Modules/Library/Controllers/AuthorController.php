<?php

namespace Modules\Library\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Modules\Library\Exceptions\AuthorHasBooksException;
use Modules\Library\Models\Author;
use Modules\Library\Requests\StoreAuthorRequest;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::withCount('books')->paginate(10);

        return view('authors.index', compact('authors'));
    }

    public function create()
    {
        return view('authors.create');
    }

    public function store(StoreAuthorRequest $request)
    {
        Author::create($request->validated());

        return redirect()
            ->route('authors.index')
            ->with('success', 'Penulis berhasil ditambahkan.');
    }

    public function destroy(Author $author)
    {
        $count = $author->books()->count();

        if ($count > 0) {
            Log::warning('Hapus penulis gagal, masih punya buku', ['author_id' => $author->id]);
            throw new AuthorHasBooksException($author->name, $count);
        }

        $author->delete();

        return redirect()
            ->route('authors.index')
            ->with('success', 'Penulis berhasil dihapus.');
    }
}
