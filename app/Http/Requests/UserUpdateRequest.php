<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserUpdateRequest extends FormRequest
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
            'current-password'  => 'required_with:new-password',
            'new-password'      => 'nullable',
            'confirm-password'  => 'nullable|same:new-password',
            'is-household-admin'=> 'nullable|bool'
        ];
    }
}
