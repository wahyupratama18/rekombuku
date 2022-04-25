<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BorrowFine extends Model
{
    use HasFactory;

    protected $fillable = ['reason', 'amount'];

    public const REASONS = [
        [
            'name' => 'Telat pengumpulan',
            'type' => 'daily',
            'amount' => 1000
        ], [
            'name' => 'Rusak',
            'type' => 'replacement',
            'amount' => 0
        ], [
            'name' => 'Hilang',
            'type' => 'replacement',
            'amount' => 1
        ]
    ];

    /**
     * Get the detail that owns the BorrowFine
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function detail(): BelongsTo
    {
        return $this->belongsTo(BorrowDetail::class);
    }
}
