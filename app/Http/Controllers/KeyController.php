<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeyController extends Controller
{
    public function update(Request $request  ){
        $request->validate([
            'key' => 'required|string|max:255', // Add any additional validation rules here
        ]);
        $key = $request->input('key');
        $authUser = Auth::user();
        $user = User::find($authUser->id);
        if( $authUser->id != $user->id )  {
            abort(404);
        }
        $user->update([
            'key' => $key,
        ]);
        return redirect()->route('/')
            ->with('success',"The key was added successfully");
    }
}
