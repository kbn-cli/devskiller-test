<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Arr;

class FormRequest extends \Illuminate\Foundation\Http\FormRequest
{
    /**
     * Get data to be validated from the request.
     *
     * @return array
     */
    protected function validationData()
    {
        $input = $this->all();

        if ($this->id === null) {
            return $input;
        }

        data_set($input, 'id', $this->id);

        return $input;
    }

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
        $status = 422;

        if (Arr::exists($errors, 'id')) {
            $status = 404;
            $errors = Arr::only($errors, ['id']);
        }

        response()->json([
            'errors' => $errors
        ], $status)->send();

        die();
    }
}