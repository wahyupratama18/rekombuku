<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class BookImage extends Model
{
    use HasFactory;

    protected $fillable = ['image_path'],
    $appends = ['image_url'];

    /**
     * Get the book that owns the BookImage
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    public function getImageUrlAttribute(): string
    {
        return Storage::url($this->image_url);
    }
}
