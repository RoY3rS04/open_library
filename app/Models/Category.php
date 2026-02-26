<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
      'name',
    ];

    public function books(): BelongsToMany {
        return $this->belongsToMany(
            Book::class,
            'category_book',
            'category_id',
            'book_id'
        );
    }
}
