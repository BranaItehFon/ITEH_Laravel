<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookCollection;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Client\ResponseSequence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    //GET
    //localhost:8000/api/books
    //NO BODY

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return BookResource::collection(Book::all());
        return new BookCollection(Book::all());
    }

    //GET
    //localhost:8000/api/books/{bookID}
    //NO BODY

    /**
     * Display the specified resource.
     *
     * @param  integer  $bookID
     * @return \Illuminate\Http\Response
     */
    public function show($bookID)
    {
        $book = Book::find($bookID);
        return is_null($book) ? response()->json('Data not found', 404) : new BookResource($book);
    }


    //DELETE
    //localhost:8000/api/books/{bookID}
    //NO BODY

    /**
     * Remove the specified resource from storage.
     *
     * @param  integer  $bookID
     * @return \Illuminate\Http\Response
     */
    public function destroy($bookID)
    {
        $book = Book::where('id', $bookID)->delete();
        return response()->json([
            "success" => true,
            "message" => "Book deleted successfully.",
            "data" => $book
        ]);
    }
}
