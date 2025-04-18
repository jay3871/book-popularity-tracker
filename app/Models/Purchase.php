<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Purchase extends Model
{
    protected $fillable = ['purchased_at'];

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}
