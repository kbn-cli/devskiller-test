<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class GetBookRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $columns = ['id', 'avg_review', 'published_year'];
        $directions = ['ASC', 'DESC'];
        return [
            'sortColumn' => [Rule::in($columns)],
            'sortDirection' => [Rule::in($directions)],
        ];
    }
}
