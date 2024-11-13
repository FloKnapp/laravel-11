<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class EpisodeStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'intensity' => 'required|integer|between:0,10',
            'duration' => 'required|integer|between:1,600',
            'type' => 'required|string',
            'symptoms' => 'required|array|min:1',
            'triggers' => [
                'required',
                function($attribute, $value, $fail) {
                    if (in_array('nothing', $value) && count($value) > 1) {
                        $fail('Wenn "Weiß nicht" gewählt wurde, darf keine andere Option gewählt sein.');
                    }
                }
            ]
        ];
    }
}
