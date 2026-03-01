<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookMetadataRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:3', 'max:50'],
            'authors' => ['required', 'string', 'min:3', 'max:255'],
            'synopsis' => ['required', 'string', 'min:3', 'max:500'],
            'categories' => ['required', 'string', 'min:3', 'max:255'],
            'release_date' => ['required', 'date'],
            'pages' => ['required', 'integer', 'min:1'],
            'language' => ['required', 'string', 'min:3', 'max:25'],
            'edition' => ['required', 'string', 'min:3', 'max:25'],
        ];
    }
}
