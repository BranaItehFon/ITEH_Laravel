<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookCollection;
use App\Models\Book;
use Illuminate\Http\Request;

class AuthorBookController extends Controller
{
    public function index($authorID)
    {
        $books = Book::get()->where('author_id', $authorID);
        if(is_null($books)) {
            return response()->json('Data not found', 404);
        }
        return new BookCollection($books);
    }
}
