<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BookController extends Controller
{
    // Grāmatu saraksts ar filtriem un popularitāti jeb pirkumiem
    public function index(Request $request)
    {
        $books = Book::with('authors') // Pievieno autorus
            ->withCount([
                // Kopējais pirkumu skaits
                'purchases as total_purchases',

                // Mēneša pirkumu skaits (šī mēneša robežās)
                'purchases as monthly_purchases' => fn($q) =>
                    $q->whereBetween('purchased_at', [now()->startOfMonth(), now()->endOfMonth()])
            ])
            // Meklēšana pēc grāmatas nosaukuma vai autora vārda
            ->when($request->search, function ($query, $search) {
                $query->where('title', 'like', "%{$search}%")
                      ->orWhereHas('authors', fn($q) => $q->where('name', 'like', "%{$search}%"));
            })
            // Kārtošana pēc mēneša popularitātes (ja norādīts)
            ->when($request->sort === 'monthly', fn($q) => $q->orderByDesc('monthly_purchases'))
            ->get();

        // Atgriež Vue komponenti ar datiem
        return Inertia::render('books/Index', [
            'books' => $books,
            'filters' => [ // Saglabā filtrus frontend pusē
                'search' => $request->input('search', ''), // Pēc noklusējuma padodam tukšas vērtības
                'sort' => $request->input('sort', ''),
            ]
        ]);
    }

    // Simulē grāmatas iegādi, pievienojot ierakstu pirkumu tabulā
    public function purchase(Book $book)
    {
        $book->purchases()->create([
            'purchased_at' => now(), // Norāda pirkuma laiku
        ]);

        // Atgriež lietotāju atpakaļ ar ziņu
        return redirect()->back()->with('success', 'Grāmata nopirkta!');
    }
}
