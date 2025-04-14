<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreInstallationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request. 
     * In this case, only a household admin is allowed to add installations to their household.
     */
    public function authorize(): bool
    {
        return Auth::check() && Auth::user()->is_household_admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'peak_power' => 'required|numeric|min:0',
            'pv_tech' => 'required|string|max:255',
            'system_loss' => 'required|numeric|min:0|max:100',
            'slope_angle' => 'required|numeric|min:0|max:90',
            'azimuth' => 'required|numeric|min:0|max:360',
            'system_cost' => 'required|numeric|min:0',
            'installer_name' => 'required|string|max:255',
        ];
    }
}
