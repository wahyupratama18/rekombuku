<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany, HasOne};

class BookItem extends Model
{
    use HasFactory;

    protected $fillable = ['is_available'];

    /**
     * Toggle Book Availability ready or not
     *
     * @return BookItem
     */
    public function toggleAvailability(): BookItem
    {
        $this->is_available = !$this->is_available;
        $this->save();

        return $this;
    }

    /**
     * Get the book that owns the BookItem
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    /**
     * Get all of the borrows for the BookItem
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function borrows(): HasMany
    {
        return $this->hasMany(BorrowDetail::class);
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
     * Get the latestCondition associated with the BookItem
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function latestCondition(): HasOne
    {
        return $this->hasOne(BookCondition::class)->latestOfMany();
    }

    /**
     * New condition for the book
     *
     * @param integer $scale
     * @return BookItem
     */
    public function newCondition(int $scale): BookItem
    {
        $this->conditions()->create(['scale' => $scale]);

        return $this;
    }
}
