<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

/**
 * Controller handling authentication related interaction.
 * 
 * Provides methods for logging in and out.
 */
class AuthenticationController extends Controller
{
    /**
     * Show the login page.
     */
    public function showLoginPage() 
    {
        return view('login');
    }

    
    /**
     * Process a user login.
     */
    public function login(LoginRequest $request)
    {
        // Retrieve provided credentials
        $credentials = $request->validated();

        // Attempt a login using these credentials
        $loginAttempt = Auth::attempt($credentials);

        // Success
        if ($loginAttempt) {
            return redirect(route('home'));
        }

        // Failure
        else
        {
            return redirect(route('login'))->withErrors('These credentials do not match our records.');
        }

    }

    /**
     * Process a user logout.
     */
    public function logout()
    {
        Auth::logout();
        return redirect(route('home'));
    }

    
}
