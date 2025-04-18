<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;

class BookApiController extends Controller
{
    public function top10()
    {
        // Atlasam top 10 grāmatas šomēnes
        $books = Book::with('authors') // Pievieno autorus
            ->withCount([
                // Mēneša pirkumu skaits (šī mēneša robežās)
                'purchases as monthly_purchases' => function ($q) {
                    $q->whereBetween('purchased_at', [now()->startOfMonth(), now()->endOfMonth()]);
                }
            ])
            // Kārtojam pēc pirkumu skaita jeb popularitātes
            ->orderByDesc('monthly_purchases')
            ->limit(10)
            ->get();

        return response()->json([
            'data' => $books,
        ]);
    }
}
