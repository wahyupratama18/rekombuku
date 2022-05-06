<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookCondition extends Model
{
    use HasFactory;

    protected $fillable = ['scale'],
    $appends = ['stars'];

    /**
     * Get the item that owns the BookCondition
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function item(): BelongsTo
    {
        return $this->belongsTo(BookItem::class);
    }

    public function getStarsAttribute(): string
    {
        return str_repeat('<i class="mdi mdi-star text-yellow-400"></i>', $this->scale)
        .str_repeat('<i class="mdi mdi-star"></i>', 5 - $this->scale).' <small>('.$this->created_at->translatedFormat('j F Y H:m').')</small>';
    }
}
