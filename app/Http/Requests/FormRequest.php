<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class FormRequest extends \Illuminate\Foundation\Http\FormRequest
{
    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        $validation = new ValidationException($validator);
        $errors = $validation->errors();

        response()->json([
            'errors' => $errors
        ], 400)->send();

        die();
    }
}