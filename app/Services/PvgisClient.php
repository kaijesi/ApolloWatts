<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\PendingRequest;

/**
 * Service class to interact with the PVGIS API.
 * Implemented according to https://joint-research-centre.ec.europa.eu/photovoltaic-geographical-information-system-pvgis/getting-started-pvgis/api-non-interactive-service_en
 */
class PvgisClient
{

    /**
     * Necessary properties
     */
    private PendingRequest $client;

    /**
     * Create a new PVGIS client.
     */
    public function __construct()
    {
        $this->client = Http::baseUrl(config('services.pvgis.base_url'));
    }

    /**
     * Request monthly output data
     */
    public function monthlyOutputProjection($installationData)
    {
        $installationData['outputformat'] = 'json'; // Always append outputformat=json to URL parameters to retrieve in JSON
        $response = $this->client->get('/PVcalc', $installationData);
        return $response;
    }
}
