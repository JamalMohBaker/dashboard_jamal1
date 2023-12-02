<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Logfile;
use App\Models\Tiles;
use App\Models\User;
use App\Models\UserTiles;
use App\Notifications\AdduserNotification;
use App\Notifications\UserTypeNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class UsersController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $typesOptions = User::typesOptions();
        $authUser = auth()->user();
        // $users = User::withTrashed()->get()->reject(function ($user) {
        //     return $user->type === 'admin';
        // });
        if ($authUser->type == 'admin') {
            $users = User::withTrashed()->get();
        } else {
            $users = User::withTrashed()->where('type', '!=', 'admin')->get();
        }
        return view('users.index',[
            'users' => $users,
            'typesOptions' => $typesOptions,
        ]);
        // $view = View::make('users.index',[
        //     'users' => $users,
        //     'typesOptions' => $typesOptions,
        // ])->render();
        // return response()->json()->view(['view' => $view]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create',[
            'user' => new User(),

        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $data = $request->validated();
        // dd($data);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('uploads/images', 'public');
            $data['image'] = $path;
        }
        $user_email = $data['email'];
        $user = User::create($data);
        $users = User::where('email',$user_email)->first();
        $user_id = $users->id;
        Logfile::create([
            'user_id' => Auth::id(),
            'type' => "Add",
            'description' => "Add User that email is  : $user_email ",
            ]);
            #Mail alert
            // $user_notify = User::where('email', '=',$user_email )->first();
            // $user_notify->notify(new AdduserNotification ($user));
            if($request->hasAny('user_tiles')){
                foreach($request->input('user_tiles') as $input){
                    UserTiles::create([
                        'tile_id' => $input,
                        'user_id' => $user_id,
                    ]);
                }
            }
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => "User ({ $user->username }) created!",
                ]);
            }
        // return redirect()
        //     ->back()
        //     ->with('success',"User ({$user->username}) created!");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $user_id = Auth::id();
        $tiles = Tiles::all();
        $typesOptions = user::typesOptions();
        $selectedTiles = [];
        foreach ($tiles as $tile) {
            $userTile = UserTiles::where('user_id', $user_id)
                ->where('tile_id', $tile->id)
                ->first();
        
            if ($userTile) {
                // If a match is found, add the tile's ID to the selectedTiles array
                $selectedTiles[] = $tile->id;
            }
        }
        return view('users.edit',[
            'user' => $user,
            'typesOptions' => $typesOptions,
            'selectedTiles' => $selectedTiles,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {
        $data = $request->validated();
        $authUser = auth()->user();
        if(!($authUser->type == 'admin') && $user->type == 'admin' ){
            return redirect()->route('users.index')
            ->with('success',"you can not update data admin");
        }
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('uploads/images', 'public');
            $data['image'] = $path;
        }
        $old_image = $user->image;
        if($request->hasAny('type')){
            $user_type = $data['type'];
        }

        $user->update($data);

        if($old_image && $old_image != $user->image){
            Storage::disk('public')->delete($old_image);
        }
        $user_email = $data['email'];
        Logfile::create([
            'user_id' => Auth::id(),
            'type' => "Update",
            'description' => "Update User that email is  : $user_email ",
            ]);
            if($request->hasAny('type')){
                if( $user_type == 'user_management'){
                $user_notify = User::where('email', '=',$user_email )->first();
                $user_notify->notify(new UserTypeNotification($user));
             }
            }
            $user->userTiles()->delete();
          
        $users = User::where('email',$user_email)->first();
        $user_id = $users->id;
        $user_username = $users->username;
            if($request->hasAny('user_tiles')){
                foreach($request->input('user_tiles') as $input){
                    $user = User::find($input);
                    UserTiles::create([
                        'tile_id' => $input,
                        'user_id' => $user_id,
                    ]);
                }
            }
        // $user->update($data);
        return redirect()->route('users.index')
        ->with('success',"User ({$user_username}) Updated!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $authUser = auth()->user();
        if(!($authUser->type == 'admin') && $user->type == 'admin' ){
            return redirect()->route('users.index')
            ->with('success',"you can not Delete admin");
        }
        $user->delete();
        $user_email = $user->email;
        Logfile::create([
            'user_id' => Auth::id(),
            'type' => "Delete",
            'description' => "Delete User that email is  : $user_email ",
            ]);
            // return response()->json([
            //     'success' => "User ({ $user->username }) deleted!",
            // ]);
        // return redirect()->route('users.index')
        // ->with('success',"User ({$user->username}) deleted!");
        return response()->json([
            'redirect' => route('users.index'),
            'success' => "User ({$user->username}) deleted!"
        ]);
    }
    public function trashed(){
        $users = User::onlyTrashed()->paginate(8);
        // return view('users.trashed',[
        //     'users' => $users ,
        // ]);

        return redirect()->back();
    }
    public function restore($id){
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();
        $user_email = $user->email;
        Logfile::create([
            'user_id' => Auth::id(),
            'type' => "Restore",
            'description' => "Restore User that email is  : $user_email ",
            ]);

        return redirect()
               ->route('users.index')
               ->with('success' , "User ({$user->username}) restored");

    }
    // public function forceDelete( $id)
    // {
    //     $user = User::onlyTrashed()->findOrFail($id);
    //     $user->forceDelete();
    //     return redirect()
    //             ->route('users.index')
    //            ->with('success' , "User ({$user->username}) deleted forever! ");
    // }
    public function editpass(User $user){
        return view('users.edit_pass',[
            'user' => $user,
        ]);
    }
    public function updatescan2fa(Request $request, User $user){

        $scanValue = $request->input('scan');
        $user->update(['scan' => $scanValue]);
        Auth::logout();
        return redirect()->route('/');

    }
}
