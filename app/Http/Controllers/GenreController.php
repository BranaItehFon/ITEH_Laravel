<?php

namespace App\Http\Controllers;

use App\Http\Resources\GenreCollection;
use App\Http\Resources\GenreResource;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GenreController extends Controller
{
    //GET
    //localhost:8000/api/genres
    //NO BODY

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return GenreResource::collection(Genre::all());
        return new GenreCollection(Genre::all());
    }


    //POST
    //localhost:8000/api/genres
    //BODY = Genre Model

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
        $genre = Genre::create($input);
        return response()->json([
            "success" => true,
            "message" => "Genre created successfully.",
            "data" => $genre
        ]);
    }

    //GET
    //localhost:8000/api/genres/{genreID}
    //NO BODY

    /**
     * Display the specified resource.
     *
     * @param  integer  $genreID
     * @return \Illuminate\Http\Response
     */
    public function show($genreID)
    {
        $genre = Genre::find($genreID);
        return is_null($genre) ? response()->json('Data not found', 404) : new GenreResource($genre);
    }


    //PUT/PATCH
    //localhost:8000/api/genres/{genreID}
    //BODY = Genre Model

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Genre $genre)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required|string',
            'city' => 'required|string',
            'summary' => 'required|string',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $genre->name = $input['name'];
        $genre->city = $input['city'];
        $genre->summary = $input['summary'];
        $genre->save();
        return response()->json([
            "success" => true,
            "message" => "Genre updated successfully.",
            "data" => $genre
        ]);
    }


    //DELETE
    //localhost:8000/api/genres/{genreID}
    //NO BODY

    /**
     * Remove the specified resource from storage.
     *
     * @param  integer  $genreID
     * @return \Illuminate\Http\Response
     */
    public function destroy($genreID)
    {
        $genre = Genre::where('id', $genreID)->delete();
        return response()->json([
            "success" => true,
            "message" => "Genre deleted successfully.",
            "data" => $genre
        ]);
    }
}
