<?php

namespace App\Http\Controllers;

use App\Http\Resources\AuthorCollection;
use App\Http\Resources\AuthorResource;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{
    //GET
    //localhost:8000/api/authors
    //NO BODY

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return AuthorResource::collection(Author::all());
        return new AuthorCollection(Author::all());
    }


    //POST
    //localhost:8000/api/authors
    //BODY = Author Model

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $author = Author::create($input);
        return response()->json([
            "success" => true,
            "message" => "Data created successfully.",
            "data" => $author
        ]);
    }

    //GET
    //localhost:8000/api/authors/{authorID}
    //NO BODY

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show($authorID)
    {
        $author = Author::find($authorID);
        return is_null($author) ? response()->json('Data not found', 404) : new AuthorResource($author);
    }


    //DELETE
    //localhost:8000/api/authors/{authorID}
    //NO BODY

    /**
     * Remove the specified resource from storage.
     *
     * @param  integer  $authorID
     * @return \Illuminate\Http\Response
     */
    public function destroy($authorID)
    {
        $author = Author::where('id', $authorID)->delete();
        return response()->json([
            "success" => true,
            "message" => "Body Type deleted successfully.",
            "data" => $author
        ]);
    }
}
