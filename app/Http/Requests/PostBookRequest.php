<?php

namespace App\Http\Requests;

class PostBookRequest extends FormRequest
{
    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'authors.*' => 'authors',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        // @TODO implement
        return [
            'isbn' => ['required', 'min:13', 'unique:books'],
            'title' => ['required'],
            'description' => ['required'],
            'authors' => ['required', 'array'],
            'authors.*' => ['required', 'integer', 'exists:authors,id'],
            'published_year' => ['required', 'integer', 'between:1900,2020'],
        ];
    }
}
