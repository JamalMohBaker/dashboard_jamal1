<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsRequest;
use App\Models\Link;
use App\Models\Logfile;
use App\Models\News;
use App\Models\Tiles;
use App\Models\User;
use App\Models\UserTiles;
use App\Notifications\NewsNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class HomePageController extends Controller
{
    // return to page addLinks
    public function index(Request $request)
    {

        // $cookie_id = $request->cookie('session_cookie');
        // if (! $cookie_id) {
        //     $cookie_id = Str::uuid();
        //     Cookie::queue('session_cookie',$cookie_id);
        // }
        // $value = Session::get('key');
        // $value1 = session('key');
        $news = News::latest()->take(4)->get();
        $auth_user = Auth::user();
        $auth_user_id = $auth_user->id;
        $tilesall = Tiles::get();

        // $tiles = UserTiles::where('user_id',$auth_user_id)->with('tile')->paginate(8);
        if ($auth_user->type === 'admin') {
            // Fetch all tiles from the 'tiles' table
            $tiles = Tiles::paginate(8);
        } else {
            // Fetch tiles associated with the user
            $tiles_user = UserTiles::where('user_id', $auth_user_id)->pluck('tile_id');
            $tiles = Tiles::whereIn('id', $tiles_user)->paginate(8);
        }

        $my_n_acc = [];
        $user = User::where('id', $auth_user_id)->first();


        foreach ($tilesall as $tile) {
            $count = Link::where('user_id', $auth_user_id)
                ->where('tile_id', $tile->id)
                ->count();
            $my_n_acc[$tile->id] = $count;
        }
        // $my_n_acc[] = Link::where('user_id', '=', $auth_user_id)->where('tile_id', '=', $tiles->id)
        //     ->count('tile_id');
        // if($auth_user->type == 'admin'){
        //     $tiles =  UserTiles::paginate(8);
        // }
        // dd($tiles);
        return view('addLinks', [
            'tiles' => $tiles,
            'my_n_acc' => $my_n_acc,
            'news' => $news,
            // 'value' => $cookie_id,
        ]);
    }
    public function getnews()
    {
        $news = News::get();
        return view('news.index', [
            'news' => $news,
        ]);
    }
    public function store(NewsRequest $request)
    {
        $data = $request->validated();

        $news = News::create($data);
        $news_id = $news->id;

        // dd($news_id);
        Logfile::create([
            'user_id' => Auth::id(),
            'type' => "Add",
            'description' => "create news that id $news_id that is : $news->news",
        ]);
        // dd($news);
        $users = User::whereIn('type', ['user', 'user_management'])->get();
        foreach ($users as $user) {
            $user->notify(new NewsNotification($news));
        }
        return response()->json(['success' => 'News has been successfully created!.']);


        // if ($request->expectsJson()) {
        //     $message = "News has been successfully created!";
        //     return  response()->json(['success' => $message]);
        // }
        // return redirect()
        //     ->route('news.getnews')
        //     ->with('success',"NEWS  created!");
    }

    public function destroy($id)
    {
        $news = News::findOrFail($id);
        $news->delete();
        Logfile::create([
            'user_id' => Auth::id(),
            'type' => "Delete",
            'description' => "delete news that id $id that is : $news->news",
        ]);
        return redirect()
            ->route('news.getnews')
            ->with('success', "NEWS $news->id Deleted!");
    }

    public function getrecoverycode($id)
    {
        $user_id = Auth::id();
        if ($id != $user_id) {
            abort(404);
        }
        $user = User::where('id', $user_id)->first();
        if (!$user) {
            abort(404); // You can customize this error handling as needed
        }

        return view('users.recoveryCode', [
            'user' => $user
        ]);
    }
    public function confirmed2fa()
    {

        return view('auth.two-factor-challenge');
    }
}
