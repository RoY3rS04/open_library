<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Author extends Model
{
    protected $fillable = [
      'first_name',
      'last_name',
    ];

    public function books(): BelongsToMany {
        return $this->belongsToMany(
            Book::class,
            'author_book',
            'author_id',
            'book_id'
        );
    }
}
