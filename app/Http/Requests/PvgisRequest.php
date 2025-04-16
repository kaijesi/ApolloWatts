<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PvgisRequest extends FormRequest
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
            'lat' => 'required|numeric|min:-90|max:90',
            'lon' => 'required|numeric|min:-180|max:180',
            'peakpower' => 'required|numeric|min:0',
            'pvtechchoice' => 'required|string|in:crystSi,CIS,CdTe',
            'loss' => 'required|numeric|min:0|max:100',
            'slope' => 'required|numeric|min:0|max:90',
            'azimuth' => 'required|numeric|min:0|max:360',
        ];
    }
}
