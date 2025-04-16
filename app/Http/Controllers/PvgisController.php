<?php

namespace App\Http\Controllers;

use App\Http\Requests\PvgisRequest;
use App\Services\PvgisClient;
use Illuminate\Http\Request;

class PvgisController extends Controller
{
    function getMonthlyProjection(PvgisRequest $request)
    {
        // Retireve validated data
        $validatedData = $request->validated();
        $client = new PvgisClient();
        $results = $client->monthlyOutputProjection($validatedData);
        //return view('analytics-results', ['results' => $results]);
        return response($results);
    }
}
