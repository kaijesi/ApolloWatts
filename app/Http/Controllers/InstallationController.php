<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInstallationRequest;
use App\Models\Installation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstallationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retireve current user
        $user = Auth::user();

        // Find installations and display them on the my-installations view
        $installations = $user->household->installations;
        return view('my-installations', ['installations' => $installations]);
    }

    /**
     * Show the form for creating a new resource.
     * --No use case at this point--
     * Installations are only added via popup/modal, there is no designated form view
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInstallationRequest $request)
    {
        // Retireve validated data
        $validatedData = $request->validated();

        // Create new installation for current user's household
        $installation = new Installation();
        $installation->fill($validatedData);
        $installation->household_id = Auth::user()->household_id;

        // Store into DB
        $installation->save();

        return redirect(route('my-installations'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Installation $installation)
    {
        // Check whether the user is allowed to view the installation based on defined policies
        if (Auth::user()->cannot('view', $installation)) {
            abort(403);
        }
        return view('installation', ['installation' => $installation]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Installation $installation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Installation $installation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Installation $installation)
    {
        //
    }
}
