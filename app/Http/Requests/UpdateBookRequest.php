<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return $this->user()->can('isAdmin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'isbn' => 'required|string',
            'year' => 'required|numeric|max:'.date('Y'),
            'penerbit' => 'required|string',
            'writers' => 'required|array',
            'writers.*' => 'required|string',
            'edition' => 'required|string',
            'price' => 'required|numeric|min:0',
            'genres' => 'nullable',
            'genres.*' => 'required|string'
        ];
    }
}
