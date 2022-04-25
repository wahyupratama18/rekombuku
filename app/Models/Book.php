<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};
use Illuminate\Database\Eloquent\Relations\{BelongsToMany, HasMany};

class Book extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'isbn',
        'year',
        'penerbit',
        'edition',
        'price'
    ];

    /**
     * Get all of the items for the Book
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items(): HasMany
    {
        return $this->hasMany(BookItem::class);
    }

    /**
     * Get all of the conditions for the Book
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function conditions(): HasMany
    {
        return $this->hasMany(BookCondition::class);
    }

    /**
     * Get all of the images for the Book
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images(): HasMany
    {
        return $this->hasMany(BookImage::class);
    }

    /**
     * Get all of the writers for the Book
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function writers(): HasMany
    {
        return $this->hasMany(BookWriter::class);
    }

    /**
     * The genres that belong to the Book
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class);
    }
}
