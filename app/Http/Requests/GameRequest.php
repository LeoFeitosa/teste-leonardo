<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GameRequest extends FormRequest
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
            'date' => 'required|date',
            'season' => 'required|integer|min:1',
            'status' => 'required|string|max:255',
            'period' => 'required|integer|min:1',
            'home_team_score' => 'required|integer|min:0',
            'visitor_team_score' => 'required|integer|min:0',
            'postseason' => 'boolean',
        ];

        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['date'] = 'sometimes|required|date';
            $rules['season'] = 'sometimes|required|integer|min:1';
            $rules['status'] = 'sometimes|required|string|max:255';
            $rules['period'] = 'sometimes|required|integer|min:1';
            $rules['home_team_score'] = 'sometimes|required|integer|min:0';
            $rules['visitor_team_score'] = 'sometimes|required|integer|min:0';
            $rules['postseason'] = 'sometimes|boolean';
        }

        return $rules;
    }
}
