<?php

namespace App\Http\Controllers;

use App\Services\SolisClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SolisController extends Controller
{
    
    function requestStationDetails() 
    {
        $user = Auth::user();
        $apiId = $user->household->solis_api_id;
        $apiKey = $user->household->solis_api_key;
        $client = new SolisClient($apiId, $apiKey);
        $result = $client->requestUserStationList();
        return response($result);


    }
}
