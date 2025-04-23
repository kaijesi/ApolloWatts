<?php

namespace App\Http\Controllers;

use App\Http\Requests\HouseholdUpdateRequest;
use App\Models\Household;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HouseholdController extends Controller
{
    /**
     * Display a listing of the resource.
     * --No use case at this point--
     * As users can only belong to one household, there is currently no situation where 
     * a list of household would need to be displayed
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     * --No use case at this point--
     * A household will only ever be created as part of a user creation in the current scope of the app
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * --No use case at this point--
     * A household will only ever be stored as part of a user creation in the current scope of the app
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $user = Auth::user();
        $household = $user->household;
        $members = $household->users;
        return view('my-household', ['household' => $household, 'members' => $members]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Household $household)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HouseholdUpdateRequest $request, Household $household)
    {
        if (Auth::user()->cannot('update', $household)) {
            abort(403);
        }

        // Get details
        $validated = $request->validated();
        
        // Update household
        $household->update($validated);

        return redirect()->route('my-household')->with('success', 'Your household information has been updated');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Household $household)
    {
        //
    }
}
