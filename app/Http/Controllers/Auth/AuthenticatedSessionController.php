<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\RecentActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Location\Facades\Location;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $ip = $request->ip();
        // $ip = '48.188.144.248';
        $currentUserInfo = Location::get($ip);

        $request->authenticate();

        if ($request->session()->regenerate()) {
            if (!empty($currentUserInfo) || $currentUserInfo) {

                $recent = new RecentActivity();
                $recent->user_id = $request->user()->id;
                $recent->ip = $ip;
                $recent->country = $currentUserInfo->countryName; 

                $recent->save();
            }

        }

        return redirect("/verify-email");
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
