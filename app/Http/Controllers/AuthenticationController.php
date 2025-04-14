<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    /**
     * Show the login page
     */
    public function showLoginPage() 
    {
        return view('login');
    }

    
    /**
     * Process a user login
     */
    public function login(LoginRequest $request)
    {
        // Retrieve provided credentials
        $credentials = $request->validated();

        $loginAttempt = Auth::attempt($credentials);

        if ($loginAttempt) {
            return redirect(route('home'));
        }

        else
        {
            return redirect(route('login'))->withErrors('These credentials do not match our records.');
        }

    }

    /**
     * Process a user logout
     */
    public function logout()
    {
        Auth::logout();
        return redirect(route('home'));
    }

    
}
