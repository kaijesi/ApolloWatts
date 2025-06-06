<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class HouseholdUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check(); // Only logged-in users, further authorisation logic in controller
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'              => 'nullable|string|max:255',
            'street'            => 'nullable|string|max:255',
            'number'            => 'nullable|string|max:255',
            'postcode'          => 'nullable|string|max:255',
            'city'              => 'nullable|string|max:255',
            'country'           => 'nullable|string|max:255',
            'solis_api_id'      => 'nullable|string|max:255',
            'solis_api_key'     => 'nullable|string|max:255',
        ];
    }
}
