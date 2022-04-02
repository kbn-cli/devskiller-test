<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostBookRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        // @TODO implement
        return [
            'isbn' => ['required', 'unique:books'],
            'title' => ['required'],
            'description' => ['required'],
            'authors' => ['required'],
            'published_year' => ['required', 'integer'],
        ];
    }
}
