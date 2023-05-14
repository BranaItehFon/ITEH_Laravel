<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
            'id' => $this->resource->id,
            'title' => $this->resource->title,
            'publisher' => $this->resource->publisher,
            'isbn' => $this->resource->isbn,
            'price' => $this->resource->price,
            'year' => $this->resource->year,
            'genre' => $this->resource->genre,
            'author' => new AuthorResource($this->resource->author)
        ];
    }

    public static $wrap = 'book';
}
