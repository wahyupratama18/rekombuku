<?php

namespace App\Http\Requests;

use App\Models\{Major, User};
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStudentRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'email' => ['required', 'email', Rule::unique(User::class, 'email')->ignore($this->student->id)],
            'major' => ['required', Rule::exists(Major::class, 'id')]
        ];
    }
}
