<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Models\UserCookie;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        // $cookie_id = $request->cookie('session_cookie');
        // if (! $cookie_id) {
        //     $cookie_id = Str::uuid();
        //     Cookie::queue('session_cookie',$cookie_id);
        // }
        return view('auth.login',[
            // 'cookie_id' => $cookie_id,
        ]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {

        $request->authenticate();

        $user_id = Auth::id();
        $user = User::where('id','=',$user_id)->first();
        $cookie_id = $request->cookie('session_cookie');

        if (!$cookie_id) {
            $cookie_id = Str::uuid();
            Cookie::queue('session_cookie', $cookie_id);
        }

        $existingRecord = UserCookie::where('user_id', $user_id)
        ->where('cookies_id', $cookie_id)
        ->first();


        if (!$existingRecord) {
        // Create a new record in the user_cookies table
        UserCookie::create([
            'cookies_id' => $cookie_id,
            'user_id' => $user_id,
            ]);
        }
        // $user= Auth::user();
        // if(! ($user->two_factor_secret) || !($user->scan)){
        //     return redirect()->route('2fa');
        // }
        // elseif(($user->two_factor_secret) && ($user->scan)){
        //     return redirect()->route('two-factor.login ');
        // }
        // return view('auth.two-factor-challenge');


        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
