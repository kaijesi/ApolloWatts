<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\PendingRequest;

class SolisClient
{
    /**
     * Necessary properties
     */
    private PendingRequest $client;
    private string $solisApiId;
    private string $solisApiSecret;
    private string $method = 'POST'; // All requests to Solis need to be POST, therefore not in constructor
    private string $contentType = 'application/json'; // Same applies here, this has to be fixed for all requests

    /**
     * Create a new class instance.
     */
    public function __construct(string $solisApiId, string $solisApiSecret)
    {
        $this->client = Http::baseUrl(config('services.solis.base_url'));
        $this->solisApiId = $solisApiId;
        $this->solisApiSecret = $solisApiSecret;
    }

    /**
     * Request a list of plants available for the given API credentials
     */
    public function requestUserStationList()
    {
        // Fill in necessary header attributes for the request
        $resource = '/v1/api/userStationList/';
        $body = '{"pageNo":1,"pageSize":10}';
        $contentMd5 = $this->generateContentMd5($body);
        $authorisation = $this->getAuthorisationString(
            apiId: $this->solisApiId,
            apiSecret: $this->solisApiSecret,
            contentMd5: $contentMd5,
            contentType: $this->contentType,
            date: gmdate("D, d M Y H:i:s T"),
            resource: $resource,
            method: $this->method
        );

        // Build header section of the request
        $this->client->withHeaders([
            'Content-Type' => $this->contentType,
            'Authorization' => $authorisation,
            'Date' => gmdate('D, d M Y H:i:s T'),
            'Content-MD5' => $contentMd5
        ]);

        // Receive a response
        $response = $this->client->post($resource, json_decode($body, true));
        return($response);

    }


    // Private functions available to this class
    private function generateContentMd5(string $body): string
    {
        $bodyToUtf8 = mb_convert_encoding($body, 'UTF-8');
        $md5Binary = md5($bodyToUtf8, true);
        return base64_encode($md5Binary);
    }

    private function getAuthorisationString(
        string $apiId,
        string $apiSecret,
        string $contentMd5,
        string $contentType,
        string $date,
        string $resource,
        string $method
    ): string {
        $stringToBeHashed = $method . "\n"
            . $contentMd5 . "\n"
            . $contentType . "\n"
            . $date . "\n"
            . $resource;
        $hashedString = base64_encode(hash_hmac('sha1', $stringToBeHashed, $apiSecret, true));

        return "API " . $apiId . ":" . $hashedString;
    }
}
