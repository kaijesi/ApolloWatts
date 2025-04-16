<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\PendingRequest;

class PvgisClient
{

    /**
     * Necessary properties
     */
    private PendingRequest $client;

    /**
     * Create a new class instance.
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
