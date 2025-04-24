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

/**
 * Controller handling interaction with users.
 * 
 * Contains methods to view, create, update and delete users.
 */
class UserController extends Controller
{
    /**
     * Display a listing of all users.
     */
    public function index()
    {
        $users = User::all();
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        return view('signup');
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(UserStoreRequest $request)
    {   
        // Retrieve validated input
        $validated = $request->validated();

        // Depending on user choice, join an existing household or create a new one

        $userHouseholdId = NULL;

        // Household creation option
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

            // Set newly created household as user's household
            $userHouseholdId = $household->id;
        }
        // Household join option
        else {
            $userHouseholdId = $validated['householdInviteCode'];
        }

        // Create user
        $user = new User;
        $user->name = $validated['firstNameInput'] . ' ' . $validated['lastNameInput'];
        $user->email = $validated['emailInput'];
        $user->password = Hash::make($validated['passwordInput']);
        $user->household_id = $userHouseholdId;

        // A household creator will always be the household's first admin
        if ($validated['householdOption'] == 'create') {
            $user->is_household_admin = true;
        }

        // Save to DB
        $user->save();

        // Process login and show home page
        Auth::login($user);
        return redirect(route('home'))->with('success', 'User created. Welcome to ApolloWatts.');
    }

    /**
     * Display the specified user.
     * 
     * In the current scope, any user should only ever be shown their own user detail page, therefore, no user object passed into this function.
     */
    public function show()
    {
        $user = Auth::user();
        return view('my-details', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified user.
     *
     * @deprecated The form is displayed in a modal and doesn't require its own route.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified user in storage.
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

            // When trying to set household admin rights to false, prevent user from removing the last admin
            if ($validated['is-household-admin'] == false) {
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
                return back()->withErrors(['current-password' => 'The provided current password does not match our records.']);
            }

            $user->password = Hash::make($validated['new-password']);
        }

        // Update user in DB
        $user->save();

        return redirect()->route('my-household')->with('success', 'Your details have been updated.');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        // Check if running user is authorised to delete this user
        if (Auth::user()->cannot('delete', $user)) {
            abort(403);
        }

        // Delete household if last admin leaves (deletion cascades to all child objects of household, meaning all users and installations)
        $adminCount = User::where('household_id', $user->household_id)->where('is_household_admin', true)->count();
        if ($user->is_household_admin && $adminCount == 1) {
            $user->household()->delete();
        }

        // Otherwise, only delete user
        $user->delete();

        return redirect()->route('home');
    }
}
