<?php

declare (strict_types=1);


namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class BookReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $user = $this->user
            ->only([
                'id', 'name',
            ]);

        return [
            // @TODO implement
            'id' => $this->id,
            'review' => $this->review,
            'comment' => $this->comment,
            'user' => $user,
        ];
    }
}
