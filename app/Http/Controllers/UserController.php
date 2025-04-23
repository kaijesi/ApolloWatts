<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Household;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of all Users.
     */
    public function index()
    {
        $users = User::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('signup');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {
        // Retrieve validated input
        $validated = $request->validated();

        // Depending on user choice, create a new or join an existing household
        $userHouseholdId = NULL;

        // Household creation
        if ($validated['householdOption'] == 'create') {
            $household = new Household;
            $household->name = $validated['lastNameInput'] . ' Household';
            $household->street = $validated['street'];
            $household->number = $validated['number'];
            $household->postcode = $validated['postcode'];
            $household->city = $validated['city'];
            $household->country = $validated['country'];
            $household->solis_api_id = $validated['solis_api_id'];
            $household->solis_api_key = $validated['solis_api_key'];

            $household->save();

            $userHouseholdId = $household->id;
        }
        // Household join
        else {
            $userHouseholdId = $validated['householdInviteCode'];
        }

        // Create user
        $user = new User;
        $user->name = $validated['firstNameInput'] . ' ' . $validated['lastNameInput'];
        $user->email = $validated['emailInput'];
        $user->password = Hash::make($validated['passwordInput']);
        $user->household_id = $userHouseholdId;
        if ($validated['householdOption'] == 'create') {
            $user->is_household_admin = true;
        }

        // DB transaction
        $user->save();


        // Proceed with login and show home page
        Auth::login($user);
        return redirect(route('home'))->with('success', 'User created. Welcome to ApolloWatts.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $user = Auth::user();
        return view('my-details', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        // Check if running user is allowed to update the user record
        if (Auth::user()->cannot('update', $user)) {
            abort(403);
        }

        // Retrieve validated data
        $validated = $request->validated();

        // Update name
        if (isset($validated['name'])) {
            $user->name = $validated['name'];
        }

        // Update admin attribute
        if (isset($validated['is-household-admin'])) {
            // For removals of admin privileges prevent user from removing the last admin
            if (!$validated['is-household-admin']) { 
                $adminCount = User::where('household_id', $user->household_id)->where('is_household_admin', true)->count();
                if ($adminCount == 1) {
                    return back()->withErrors('You cannot remove the last remaining admin');
                }
            }
            
            $user->is_household_admin = $validated['is-household-admin'];
        }

        // Check current password and overwrite with new one if correct
        if (isset($validated['new-password'])) {
            if (!Hash::check($validated['current-password'], $user->password)) {
                return back()->withErrors(['current-password' => 'The provided current password does not match your current password.']);
            }

            $user->password = Hash::make($validated['new-password']);
        }

        // Update user in DB
        $user->save();

        return redirect()->route('my-household')->with('success', 'Your details have been updated.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if (Auth::user()->cannot('delete', $user)){
            abort(403);
        }

        // Delete household if admin leaves (deletion cascades to all child objects of household, meaning all users and installations)
        if ($user->is_household_admin) 
        {
            $user->household()->delete();
        }
        
        // Otherwise, only delete user
        $user->delete();
        
        return redirect()->route('home');
    }
}
