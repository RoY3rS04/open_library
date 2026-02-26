<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Book extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'title',
        'description',
        'synopsis',
        'release_date',
        'publisher',
        'isbn',
        'status',
        'pages',
        'language',
        'pdf_path',
        'edition',
    ];

    public function authors(): BelongsToMany {
        return $this->belongsToMany(
            Author::class,
            'author_book',
            'book_id',
            'author_id'
        );
    }

    public function categories(): BelongsToMany {
        return $this->belongsToMany(
            Category::class,
            'category_book',
            'book_id',
            'category_id'
        );
    }

    public function submittedBy(): BelongsTo {
        return $this->belongsTo(User::class, 'submitted_by');
    }

    public function approvedBy(): BelongsTo {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
