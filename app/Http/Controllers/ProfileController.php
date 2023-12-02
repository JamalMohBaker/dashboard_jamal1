<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Logfile;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request , $user_id): View
    {
        $user = Auth::user()->id;
        if ($user_id == $user ) {
            return view('users.profile', [
                'user' => Auth::user(),
            ]);
        }

        abort(403, 'Unauthorized');

    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request , User $user): RedirectResponse
    {
        // $request->user()->fill($request->validated());



        // $request->user()->save();
        // $data = $request->validated();
        $data = $request->user()->fill($request->validated());
         if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
        if ($request->hasFile('image')) {

            $file = $request->file('image');
            $path = $file->store('uploads/images', 'public');
            $data['image'] = $path;
        }
        // $user->fill($data)->save();
        $request->user()->save();

        $old_image = $user->image;

        // $user->update($data);


        if($old_image && $old_image != $user->image){
            Storage::disk('public')->delete($old_image);
        }
        $username = $data['username'];
        Logfile::create([
            'user_id' => Auth::id(),
            'type' => "Update",
            'description' => "Update Profile that username : $username ",
        ]);
        // dd($data);
        return Redirect::route('profile.edit', Auth::user()->id)->with('success', 'profile-updated');
        // route('profile.edit', Auth::user()->id)
    }

    /**
     * Delete the user's account.
     */
    // public function destroy(Request $request): RedirectResponse
    // {
    //     $request->validateWithBag('userDeletion', [
    //         'password' => ['required', 'current_password'],
    //     ]);

    //     $user = $request->user();

    //     Auth::logout();

    //     $user->delete();

    //     $request->session()->invalidate();
    //     $request->session()->regenerateToken();

    //     return Redirect::to('/login');
    // }
}
