<?php

declare (strict_types=1);


namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $authors = $this->authors
            ->makeHidden([
                'pivot',
            ]);

        $reviews = [
            'avg' => $this->reviews->avg('review') ?? 0,
            'count' => $this->reviews->count(),
        ];

        return [
            'id' => $this->id,
            'isbn' =>  $this->isbn,
            'title' => $this->title,
            'description' => $this->description,
            'published_year' => $this->published_year,
            'authors' => $authors,
            'reviews' => $reviews,
        ];
    }
}
