<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Installation;

class InstallationStoreRequest extends FormRequest
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
            'name'              => 'required|string|max:255',
            'latitude'          => 'required|numeric|min:-90|max:90',
            'longitude'         => 'required|numeric|min:-180|max:180',
            'peak_power'        => 'required|numeric|min:0',
            'pv_tech'           => 'required|string|in:crystSi,CIS,CdTe', // Available PV tech names as required by PVGIS API
            'system_loss'       => 'required|numeric|min:0|max:100',
            'slope_angle'       => 'required|numeric|min:0|max:90',
            'azimuth'           => 'required|numeric|min:0|max:360',
            'system_cost'       => 'required|numeric|min:0',
            'installer_name'    => 'required|string|max:255',
        ];
    }
}
