<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
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
    public function store(StoreUserRequest $request)
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
        return redirect(route('home'));
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
