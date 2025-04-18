<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Izveidojam 10 autorus
        $authors = Author::factory(10)->create();

        // Izveidojam 15 grāmatas
        Book::factory(15)->create()->each(function ($book) use ($authors) {
            // Katrai grāmatai pievieno 1 līdz 3 autorus random
            $book->authors()->attach(
                $authors->random(rand(1, 3))->pluck('id')->toArray()
            );

            // Izveidojam random skaitu pirkumu (0–20)
            $purchaseCount = rand(0, 20);

            for ($i = 0; $i < $purchaseCount; $i++) {
                $book->purchases()->create([
                    // Daļa pirkumu šomēnes, daļa agrāk
                    'purchased_at' => now()->subDays(rand(0, 90)),
                ]);
            }
        });
    }
}
