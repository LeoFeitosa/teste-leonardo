<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlayerRequest extends FormRequest
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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'height' => 'required|string|max:255',
            'weight' => 'required|numeric',
            'jersey_number' => 'required|numeric',
            'college' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'team_id' => 'required|exists:teams,id',
        ];

        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['draft_year'] = 'sometimes|nullable|numeric';
            $rules['draft_round'] = 'sometimes|nullable|numeric';
            $rules['draft_number'] = 'sometimes|nullable|numeric';
            $rules['first_name'] = 'sometimes|string|max:255';
            $rules['last_name'] = 'sometimes|string|max:255';
            $rules['position'] = 'sometimes|string|max:255';
            $rules['height'] = 'sometimes|string|max:255';
            $rules['weight'] = 'sometimes|numeric';
            $rules['jersey_number'] = 'sometimes|numeric';
            $rules['college'] = 'sometimes|string|max:255';
            $rules['country'] = 'sometimes|string|max:255';
        }

        return $rules;
    }
}
