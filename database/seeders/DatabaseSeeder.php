<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Author;
use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Genre;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {


        User::truncate();
        Genre::truncate();
        Author::truncate();
        Book::truncate();

        User::factory(10)->create();

        Genre::insert([
            [
                "name" => "Drama",
                "city" => "New York",
                "summary" => "Drama is genre where everything is serious and heavy emotions are involved."
            ],
            [
                "name" => "Comedy",
                "city" => "London",
                "summary" => "Comedy is meant to make people laugh."
            ],
            [
                "name" => "Romance",
                "city" => "Paris",
                "summary" => "Love is the most wonderful emotion that everybody should experience."
            ]
        ]);

        Author::insert([
            [
                "name" => "Ivo Andric",
                "birth_year" => 1932,
                "is_alive" => false,
                "nationality" => "Serbian Bosnian",
                "capital" => 24751
            ],
            [
                "name" => "Desanka Maksimovic",
                "birth_year" => 1922,
                "is_alive" => false,
                "nationality" => "Serbian",
                "capital" => 25511
            ]
        ]);


        $book_1 = new Book;
        $book_1->title = "Na Drini Cuprija";
        $book_1->isbn = "2343452534";
        $book_1->publisher = "Laguna izdavac";
        $book_1->price = 860;
        $book_1->year = 1961;
        $book_1->genre_id = 1;
        $book_1->author_id = 1;
        $book_1->save();

        $book_2 = new Book;
        $book_2->title = "Pored puta";
        $book_2->isbn = "12354345";
        $book_2->publisher = "Laguna izdavac";
        $book_2->price = 999;
        $book_2->year = 1965;
        $book_2->genre_id = 1;
        $book_2->author_id = 1;
        $book_2->save();

        Book::create([
            "title" => "Zlatni leptir",
            "isbn" => "213546789",
            "publisher" => "Delfi knjizara",
            "price" => 720,
            "year" => 1966,
            "genre_id" => 2,
            "author_id" => 2
        ]);
    }
}
