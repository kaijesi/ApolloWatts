<?php

namespace App\Http\Controllers;

use App\Http\Requests\HouseholdUpdateRequest;
use App\Models\Household;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Controller handling interaction with households.
 * 
 * Provides methods for showing & updating households.
 */
class HouseholdController extends Controller
{
    /**
     * Display a list of households.
     * 
     * @deprecated No use case for listing households at this point.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new household.
     * 
     * @deprecated No use case for creating new households, as households are only created as part of user creation.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created household in storage.
     * 
     * @deprecated No use case for storing new households, as households are only created as part of user creation.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the user's household.
     * 
     * Shows the current running user's household and its household members.
     * In the current scope, any user should only ever be shown their own household, therefore, no household object passed into this function.
     */
    public function show()
    {
        // Find the current user
        $user = Auth::user();

        // Retrieve their household and its members
        $household = $user->household;
        $members = $household->users;

        // Display this data
        return view('my-household', ['household' => $household, 'members' => $members]);
    }

    /**
     * Show the form for editing the specified household.
     * 
     * @deprecated The form is displayed in a modal and doesn't require its own route.
     */
    public function edit(Household $household)
    {
        //
    }

    /**
     * Update the specified household in storage.
     */
    public function update(HouseholdUpdateRequest $request, Household $household)
    {
        // Check if the current user is authorised to update this household
        if (Auth::user()->cannot('update', $household)) {
            abort(403);
        }

        // Get details for the update
        $validated = $request->validated();
        
        // Update household
        $household->update($validated);

        // Return to household page
        return redirect()->route('my-household')->with('success', 'Your household information has been updated');

    }

    /**
     * Remove the specified household from storage.
     * 
     * @deprecated A household deletion is only initiated via user deletion to prevent empty households
     */
    public function destroy(Household $household)
    {
        //
    }
}
