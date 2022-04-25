<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};

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
        return $this->belongsTo(User::class, 'foreign_key', 'other_key');
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
}
