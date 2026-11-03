<?php

namespace Modules\Library\Exceptions;

use Exception;

class AuthorHasBooksException extends Exception
{
    public function __construct(protected string $authorName, protected int $bookCount)
    {
        parent::__construct("Penulis '{$authorName}' masih memiliki {$bookCount} buku dan tidak dapat dihapus.");
    }

    public function render($request)
    {
        if ($request->expectsJson()) {
            return response()->json([
                'message' => $this->getMessage(),
                'error' => 'author_has_books',
            ], 422);
        }

        return back()->with('error', $this->getMessage());
    }
}