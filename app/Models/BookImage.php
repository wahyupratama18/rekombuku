<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class BookImage extends Model
{
    use HasFactory;

    protected $fillable = ['image_path'],
    $appends = ['image_url'];

    public function getImageUrlAttribute(): string
    {
        return Storage::url($this->image_url);
    }
}
