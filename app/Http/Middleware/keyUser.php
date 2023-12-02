<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class keyUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $authUser = Auth::user();
        // $auth_user_id = User::find($authUser->id);
        $user = User::where('id', $authUser->id)->first();
        $existingKey = $user->key;
        if(!$existingKey){
            $key = random_bytes(32);
            User::create([
                'key' => $key,
            ]);

        }
        return $next($request);
    }
}
