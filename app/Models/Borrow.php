<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Collection, Model};
use Illuminate\Database\Eloquent\Relations\HasMany;

class Borrow extends Model
{
    use HasFactory;

    /**
     * Validated Borrowing by Admin
     *
     * @return Borrow
     */
    public function validateByAdmin(): Borrow
    {
        $this->validated_at = now();
        $this->save();

        $this->reverseBookStatus($this->details);

        return $this;
    }

    /**
     * Reverse book status to available / not
     *
     * @param Collection $details
     * @param boolean $state
     * @return void
     */
    private function reverseBookStatus(Collection $details, bool $state = false): void
    {
        $books = $details->pluck('book_item_id')->toArray();

        BookItem::query()
        ->whereIn('id', $books)
        ->update(['is_available' => $state]);
    }

    /**
     * Get all of the details for the Borrow
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function details(): HasMany
    {
        return $this->hasMany(BorrowDetail::class);
    }
}
