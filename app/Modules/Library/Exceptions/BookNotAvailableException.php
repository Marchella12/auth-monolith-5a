<?php

namespace Modules\Library\Exceptions;

use Exception;

class BookNotAvailableException extends Exception
{
    public function __construct(protected string $title)
    {
        parent::__construct("Buku '{$title}' tidak tersedia (stok 0).");
    }

    public function render($request)
    {
        if ($request->expectsJson()) {
            return response()->json([
                'message' => $this->getMessage(),
                'error' => 'book_not_available',
            ], 422);
        }

        return back()->with('error', $this->getMessage());
    }
}
