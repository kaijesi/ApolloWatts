<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;

/**
 * Service class handling interaction with the SolisCloud API.
 * Implemented according to https://oss.soliscloud.com/templet/%5BExternal%5D%20SolisCloud%20Monitoring%20API.pdf
 */
class SolisClient
{      
    /**
     * Properties
     */
    private PendingRequest $client;
    private string $solisApiId;
    private string $solisApiSecret;
    // All requests to Solis need to be POST & application/json, therefore not in constructor
    private string $method = 'POST'; 
    private string $contentType = 'application/json';

    /**
     * Creates a new Solis Client
     */
    public function __construct(string $solisApiId, string $solisApiSecret)
    {
        $this->client = Http::baseUrl(config('services.solis.base_url'));
        $this->solisApiId = $solisApiId;
        $this->solisApiSecret = $solisApiSecret;
    }

    /**
     * Request a list of plants available for this client
     */
    public function requestUserStationList(): Response
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

    /**
     * MD-5 hash the body of the request
     * 
     * @param string $body
     * @return string
     */
    private function generateContentMd5(string $body): string
    {
        $bodyToUtf8 = mb_convert_encoding($body, 'UTF-8');
        $md5Binary = md5($bodyToUtf8, true);
        return base64_encode($md5Binary);
    }

    /**
     * Generate the authorisation header, a SHA1 hash of a number of the request's attributes
     * 
     * @param string $apiId (A valid API ID for soliscloud.com)
     * @param string $apiSecret (A valid API Secret for soliscloud.com)
     * @param string $contentMd5 (The request's body, hashed with MD-5)
     * @param string $contentType (The request's content type, usually 'application/json')
     * @param string $date (The current date/time formatted "D, d M Y H:i:s T")
     * @param string $resource (The request's target resource at soliscloud.com)
     * @param string $method (The request's method, usually 'POST')
     * 
     * @return string (The string)
     * 
     */
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
