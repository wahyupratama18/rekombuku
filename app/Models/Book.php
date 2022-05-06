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

    /**
     * Create New Items
     *
     * @param integer $qty
     * @return Book
     */
    public function newItems(int $qty): Book
    {
        $this->items()->createMany(
            array_fill(0, $qty, ['is_available' => true])
        )->each(fn($item) => $item->newCondition(5));

        return $this;
    }

    /**
     * Synchronize Genres
     *
     * @param array $genres
     * @return Book
     */
    public function syncGenres(array $genres = []): Book
    {
        if (!empty($genres)) {
            $genres = $this->upsertGenre($genres);
        }
        
        $this->genres()->sync($genres);

        return $this;
    }

    /**
     * Upserting Genre
     *
     * @param array $genres
     * @return array
     */
    private function upsertGenre(array $genres): array
    {
        foreach ($genres as $genre) {
            $sync[] = Genre::query()
            ->firstOrCreate(['name' => $genre])
            ->id;
        }

        return $sync;
    }

    /**
     * Implode Genre
     *
     * @return string
     */
    public function implodeGenres(): string
    {
        return $this->genres->pluck('name')->implode(', ');
    }
    
    /**
     * Synchronize Writers
     *
     * @param array $writers
     * @return Book
     */
    public function syncWriters(array $writers): Book
    {
        // Delete all of them first, then create a new record
        $this->writers()->delete();

        $this->writers()->createMany(
            collect($writers)
            ->map(fn($writer) => ['book_id' => $this->id, 'name' => $writer]),
        );
        
        return $this;
    }

    /**
     * Implode Writer
     *
     * @return string
     */
    public function implodeWriters(): string
    {
        return $this->writers->pluck('name')->implode(', ');
    }
}
