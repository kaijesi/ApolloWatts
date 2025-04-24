<?php

namespace App\Http\Controllers;

use App\Http\Requests\InstallationStoreRequest;
use App\Http\Requests\StoreInstallationRequest;
use App\Models\Installation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Controller handling interaction with installations.
 * 
 * Provides methods to display, create, edit and delete installations.
 */
class InstallationController extends Controller
{
    /**
     * Display a listing of installations.
     */
    public function index()
    {
        // Retrieve current user
        $user = Auth::user();

        // Find installations for their household
        $installations = $user->household->installations;

        // Display these installations
        return view('my-installations', ['installations' => $installations]);
    }

    /**
     * Show the form for creating a new installation.
     * 
     * @deprecated The form is displayed in a modal and doesn't require its own route.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created installation in storage.
     */
    public function store(InstallationStoreRequest $request)
    {
        // Check if the current user is authorised to create a new installation
        if (Auth::user()->cannot('create', Installation::class)) {
            abort(403);
        }

        // Retrieve validated data from form
        $validatedData = $request->validated();

        // Create new installation for current user's household
        $installation = new Installation();
        $installation->fill($validatedData);
        $installation->household_id = Auth::user()->household_id;

        // Store into DB
        $installation->save();

        // Return to installations list view
        return redirect()->route('my-installations')->with('success', 'Your installation has been created.');
    }

    /**
     * Display the specified installation.
     */
    public function show(Installation $installation)
    {
        // Check whether the user is allowed to view the installation
        if (Auth::user()->cannot('view', $installation)) {
            abort(403);
        }
        
        // Display the installation
        return view('installation', ['installation' => $installation]);
    }

    /**
     * Show the form for editing the specified resource.
     * 
     * @deprecated The form is displayed in a modal and doesn't require its own route.
     */
    public function edit(Installation $installation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InstallationStoreRequest $request, Installation $installation)
    {
        // Check if user is allowed to update the installation
        if (Auth::user()->cannot('update', $installation)) {
            abort(403);
        }

        // Retrieve validated data
        $validatedData = $request->validated();

        // Update installation in DB
        $installation->update($validatedData);

        // Show updated installation
        return redirect()->route('installations.show', $installation)->with('success', 'Your installation has been updated.');
    }

    /**
     * Remove the specified installation from storage.
     */
    public function destroy(Installation $installation)
    {
        // Check whether the user is allowed to delete the installation
        if (Auth::user()->cannot('delete', $installation)) {
            abort(403);
        }

        // Delete installation
        $installation->delete();

        // Return to installations list view
        return redirect(route('my-installations'));
    }
}
