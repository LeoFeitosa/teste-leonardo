<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeamRequest extends FormRequest
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
        $rules = [
            'conference' => 'required|string|max:255',
            'division' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'full_name' => 'required|string|max:255',
            'abbreviation' => 'required|string|max:3',
        ];

        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['conference'] = 'sometimes|required|string|max:255';
            $rules['division'] = 'sometimes|required|string|max:255';
            $rules['city'] = 'sometimes|required|string|max:255';
            $rules['name'] = 'sometimes|required|string|max:255';
            $rules['full_name'] = 'sometimes|required|string|max:255';
            $rules['abbreviation'] = 'sometimes|required|string|max:3';
        }

        return $rules;
    }
}
