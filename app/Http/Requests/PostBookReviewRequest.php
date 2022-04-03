<?php

namespace App\Http\Requests;

class PostBookReviewRequest extends FormRequest
{
    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'id' => 'book',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            // @TODO implement
            'id' => ['exists:books'],
            'review' => ['required', 'integer', 'between:1,10'],
            'comment' => ['string'],
        ];
    }
}
