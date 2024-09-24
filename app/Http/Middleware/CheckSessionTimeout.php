<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CheckSessionTimeout
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is logged in
        if (Auth::check()) {
            $lastLogin = session('last_login_time'); // Get the last login time from the session

            // If last login time is not set, set it to now
            if (!$lastLogin) {
                session(['last_login_time' => Carbon::now()]);
            } else {
                // Check if the session has exceeded 10 hours
                $timeoutLimit = Carbon::parse($lastLogin)->addHours(10);

                if (Carbon::now()->greaterThan($timeoutLimit)) {
                    // If the session has expired, log out the user
                    Auth::logout();
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();

                    return redirect('/')->with('error', 'Your session has expired. Please log in again.');
                }
            }
        }

        return $next($request);
    }
}
