<?php

namespace App\Http\Controllers;

use App\Services\SolisClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Controller handling interaction with the SolisCloud API.
 * 
 * // Current state: Retrieves a list of available stations available with the credentials saved for the current user's household.
 * // Future state: Could be expanded for other types of analytics requests; API credentials could be passed separately
 */
class SolisController extends Controller
{
    /**
     * Retrieve a list of stations available for the current user.
     * Return these as HTTP response.
     */
    function requestStationDetails() 
    {
        // Find current user and the Solis credentials for their household
        $user = Auth::user();
        $apiId = $user->household->solis_api_id;
        $apiKey = $user->household->solis_api_key;

        // Handle errors for when no Solis credentials are saved
        if (!($apiId || $apiKey)) {
            return response('{"message": "You cannot access Solis features without valid API credentials"}');
        }

        // Send a request for a list of stations (installations) to the Solis API
        $client = new SolisClient($apiId, $apiKey);
        $result = $client->requestUserStationList();

        // Return result
        return response($result);
    }
}
