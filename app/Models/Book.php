<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    use HasFactory;

    // Attiecība: grāmatai var būt vairāki autori
    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class);
    }

    // Attiecība: grāmatai var būt daudzi pirkumi
    public function purchases(): HasMany
    {
        return $this->hasMany(Purchase::class);
    }
}
