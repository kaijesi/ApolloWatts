<?php

namespace App\Http\Controllers;

use App\Http\Requests\PvgisRequest;
use App\Services\PvgisClient;
use Illuminate\Http\Request;

/**
 * Controller handling interaction with the PVGIS API
 * 
 * // Current state: Contains a method to access a monthly energy output projection for a specific installation
 * // Future state: Other types of analytics that might be requested should be added here (e.g. hourly projections, horizon modeling etc.)
 */
class PvgisController extends Controller
{
    /**
     * Retrieve monthly projection results using installation parameters (latitude, longitude etc.) required in a PvgisRequest.
     * Return these as a HTTP response. 
     */
    function getMonthlyProjection(PvgisRequest $request)
    {
        // Retrieve validated data from request
        $validatedData = $request->validated();

        // Create a new client for interacting with the PVGIS API
        $client = new PvgisClient();

        // Using this client, retrieve the montly output projections
        $results = $client->monthlyOutputProjection($validatedData);

        // Return results received from PVGIS
        return response($results);
    }
}
