<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Any user should be able to create an account
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'firstNameInput'        => 'required|string',
            'lastNameInput'         => 'required|string',
            'passwordInput'         => 'required|string',
            'emailInput'            => 'required|email|unique:users,email', // Make sure user does not yet exist
            'householdOption'       => 'required|in:join,create', // User needs to join or create a household
            // Required if join
            'householdInviteCode'   => 'required_if:householdOption,join|exists:households,id|string|max:255',
            // Required if create
            'street'                => 'required_if:householdOption,create|string|max:255',
            'number'                => 'required_if:householdOption,create|string|max:255',
            'postcode'              => 'required_if:householdOption,create|string|max:255',
            'city'                  => 'required_if:householdOption,create|string|max:255',
            'country'               => 'required_if:householdOption,create|string|max:255',
            // Solis data, always optional
            'solis_api_id'          => 'nullable|string|max:255',
            'solis_api_key'         => 'nullable|string|max:255',
        ];
    }
}
