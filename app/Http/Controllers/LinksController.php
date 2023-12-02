<?php

namespace App\Http\Controllers;

use App\Http\Requests\LinkRequest;
use App\Models\Link;
use App\Models\LinkPermission;
use App\Models\Logfile;
use App\Models\Tiles;
use App\Models\User;
use App\Models\UserTiles;
use App\Notifications\ShowLinkUserNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
// use Intervention\


class LinksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort(404);

    }
    public function homepage(){
        $auth_user = Auth::user();
        $auth_user_id = $auth_user->id;
        // $user_id = Link::user_id();

        // $links = Link::where('user_id', '=', $auth_user_id)->get();
        // $links = $auth_user->links;
        $links = Link::withCount("linkPermissions")->where("user_id",$auth_user_id)->latest()->get();

        //  dd($links);
        // $links->map(function ($link) {
        //     $link->password = Crypt::decrypt($link->password);
        //     return $link;
        // });


        $users = User::where('id', '!=', $auth_user_id)->get();
        // $userPermissionCounts = [];
        // foreach ($links as $link) {
        //     // Calculate the user permission count for each link
        //     $userPermissionCount = $link->linkPermissions->count();

        //     // Store the count in the array with the link ID as the key
        //     $userPermissionCounts[$link->id] = $userPermissionCount;
        // }

        return view('homePage',[
            'links' => $links,
            'users' => $users,
            // 'user_permissions' => $userPermissions,

         ]);
    }

    public function index1($tileId)
    {
        $auth_user = Auth::user();
        $auth_user_id = $auth_user->id;
        // $user_id = Link::user_id();
        $tile = Tiles::findorFail($tileId);
        $tilename = $tile->name;
        if (!$tile) {
            abort(404);
        }
        $exists_tiles = UserTiles::where('tile_id',$tileId)->where('user_id',$auth_user_id)->get();
        if ($exists_tiles == '[]' && ($auth_user->type != 'admin') ){
            abort(404);
        }

        $links = Link::where('user_id', '=', $auth_user_id)
        ->where('tile_id', '=', $tileId)
        ->withTrashed()
        ->get();
        $links->map(function ($link) {
            $link->password = Crypt::decrypt($link->password);
            return $link;
        });


        // $noaccper = LinkPermission::weher('link_id','=',$link)
        $userPermissionCounts = [];
        foreach ($links as $link) {
            // Calculate the user permission count for each link
            $userPermissionCount = $link->linkPermissions->count();

            // Store the count in the array with the link ID as the key
            $userPermissionCounts[$link->id] = $userPermissionCount;
        }
        return view('links.index',[
           'links' => $links,
           'tileId' => $tileId,
           'tilename' => $tilename,
           'userPermissionCounts' => $userPermissionCounts,


        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect()->back();
    }

    public function createLink($tileId)
    {
        $authUserId = Auth::id();
        $users = User::where('id', '!=', $authUserId)->get();
        $tile = Tiles::findorFail($tileId);

        if (!$tile) {
            abort(404);
        }
        $tilename = $tile->name;
        return view('links.create',[
            'link'=> new link(),
            'tileId' => $tileId,
            'tilename' => $tilename,
            'users' => $users,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LinkRequest $request , Link $link)
    {

        $data = $request->validated();

        if($data['user_id'] != Auth::user()->id){
            abort(403);
        }
        $data['user_id'] = Auth::user()->id;
        $data_to_encrypt = $data['password'];
        $encryptedPassword = Crypt::encrypt($data_to_encrypt);
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $path = $file->store('uploads/images', 'public');
            $data['logo'] = $path;
        }

        $data['password'] = $encryptedPassword;
        $link = Link::create($data);
        $userperm='';
        if($request->hasAny('user_permissions')){
            $userperm.=',And add permissions for users :';
            foreach($request->input('user_permissions') as $input){
                $user = User::find($input);
                if ($user) {
                    $userperm .= $user->username . ', ';
                }
                LinkPermission::create([
                    'link_id' => $link->id,
                    'user_permissions' => $input,
                ]);
            }
        }
        // dd($userperm);
        Logfile::create([
            'user_id' => Auth::id(),
            'type' => "Add",
            'description' => "Add links that id $link->id, that name is : $link->name $userperm",
        ]);


        return redirect()
            ->back()
            ->with('success',"Link ( $link->name ) created!");
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function userAcc(){
        $users_acc = LinkPermission::where('user_permissions','=',Auth::id())->get();

        $users_acc->each(function ($user_acc) {
            $user_acc->link->password = Crypt::decrypt($user_acc->link->password);
        });

        $userIds = Link::whereHas('linkPermissions', function ($query) {
            $query->select('link_id')->distinct();
        })->pluck('user_id')->toArray();

        return view('links.userAcc',[
            'users_acc' => $users_acc,
            'userIds' => $userIds,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Link $link)
    {
        $authUserId = Auth::id();
        $link = Link::with('tile','user')->find($link->id);
        if($link->user_id != Auth::id()){
            abort(404);
        }
        // $user_permissions = Link::find($link->id);
        $users = User::where('id', '!=', $authUserId)->get();
        $user_permissions = LinkPermission::where('link_id','=',$link->id);

        return view('links.edit',[
            'link' => $link,
            'users' => $users,
            'user_permissions' => $user_permissions,
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LinkRequest $request , Link $link)
    {
        $data = $request->validated();
        if($request->hasAny('password')){
            $data_to_encrypt = $data['password'];
            $encryptedPassword = Crypt::encrypt($data_to_encrypt);
            $data['password'] = $encryptedPassword;
        }

        $data['user_id'] = Auth::user()->id;
        if($data['user_id'] != Auth::user()->id){
            abort(403);
        }

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $path = $file->store('uploads/images', 'public');
            $data['logo'] = $path;
        }
        Logfile::create([
            'user_id' => Auth::id(),
            'type' => "Update",
            'description' => "Update links that id $link->id, that name is : $link->name ",
        ]);

        // dd($data);
        $link->update($data);
        if(! $request->hasAny('password')){
            $link->linkPermissions()->delete();
        }

        // $user_permissions = LinkPermission::where('link_id','=',$link->id)->findOrFail();
        if($request->hasAny('user_permissions')){
            foreach($request->input('user_permissions') as $input){
                $user = User::find($input);
                if ($user) {
                    // $user->notify(new ShowLinkUserNotification($user));
                }
                LinkPermission::create([
                    'link_id' => $link->id,
                    'user_permissions' => $input,
                ]);
            }
        }
        return redirect()
            ->back()
            ->with('success',"Link ( $link->name ) Updated!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Link $link)
    {
        $link->delete();
        Logfile::create([
            'user_id' => Auth::id(),
            'type' => "Delete",
            'description' => "Delete links that id $link->id, that name is : $link->name ",
        ]);
        return redirect()
            ->back()
            ->with('success',"Link ( $link->name ) Deleted!");
    }
    public function restore($id){
        $link = Link::onlyTrashed()->findOrFail($id);
        $link->restore();
        Logfile::create([
            'user_id' => Auth::id(),
            'type' => "Restore",
            'description' => "Restore links that id $link->id, that name is : $link->name ",
        ]);
        return redirect()
                ->back()
               ->with('success' , "link ({$link->name}) restored");

    }



}
