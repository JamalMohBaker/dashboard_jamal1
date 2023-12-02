<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class twofacode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user= Auth::user();
        if(!($user->two_factor_secret) || !($user->scan)){
            return redirect()->route('2fa');
        }
        // elseif($user->two_factor_secret && $user->scan){
        //     return redirect()->view('auth.two-factor-challenge');
        // }
        return $next($request);
    }
}
