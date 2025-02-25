<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthenticatedSessionController extends Controller
{
    /**
     * Show the login form.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle the login request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate login credentials
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        // Attempt to log the user in
        if (Auth::attempt($credentials)) {
            // Regenerate the session to prevent session fixation attacks
            $request->session()->regenerate();
			
			if (auth()->check() && auth()->user()->isAdmin()) {
			return view('admin.index');
			}else{
				return redirect()->route('frontend.cars.index');
			}
            // Redirect the user to the intended page or home page
            //return redirect()->intended(route('frontend.cars.index'));
        }

        // If login attempt fails, return to the login page with an error
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Log the user out and destroy the session.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        // Log out the user
        Auth::logout();

        // Invalidate the session and regenerate it to prevent session fixation attacks
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect to the homepage after logout
        return redirect()->route('home');
    }
}
