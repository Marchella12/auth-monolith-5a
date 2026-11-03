<?php

namespace Modules\Library\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'isbn',
        'published_year',
        'price',
        'stock',
        'author_id',
    ];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }
}
