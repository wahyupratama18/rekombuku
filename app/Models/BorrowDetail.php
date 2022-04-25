<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasOne};

class BorrowDetail extends Model
{
    use HasFactory;

    /**
     * Get the borrow that owns the BorrowDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function borrow(): BelongsTo
    {
        return $this->belongsTo(Borrow::class);
    }

    /**
     * Get the item that owns the BorrowDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function item(): BelongsTo
    {
        return $this->belongsTo(BookItem::class);
    }

    /**
     * Get the fine associated with the BorrowDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function fine(): HasOne
    {
        return $this->hasOne(BorrowFine::class);
    }
}
