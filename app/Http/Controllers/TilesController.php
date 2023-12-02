<?php

namespace App\Http\Controllers;

use App\Http\Requests\TileRequest;
use App\Models\Logfile;
use App\Models\Tiles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TilesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tiles = Tiles::withTrashed()->get();
        if (request()->ajax()) {
            return view('tiles.index', [
                'tiles' => $tiles,
                'newtiles' => new Tiles(),
                ])->render();
        }
        return view('tiles.index',[
            'tiles' => $tiles,
            'newtiles' => new Tiles(),
        ]);
        // return view('tiles.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tiles.create',[
            'tiles' => new Tiles(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TileRequest $request)
    {
        $data = $request->validated();
        // dd($data);
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $path = $file->store('uploads/images', 'public');
            $data['logo'] = $path;
        }
        $tiles = Tiles::create($data);
        $tailname = $data['name'];
        Logfile::create([
            'user_id' => Auth::id(),
            'type' => "Add",
            'description' => "Add Tiles that name is  : $tailname ",
        ]);
        return redirect()
            // ->route('tiles.index')
            ->back()
            ->with('success',"tiles ({$tiles->name}) created!");
        // return response()->json(['success' => true, 'message' => "Tile ({$tiles->name}) successfully"]);

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
    public function edit(Tiles $tile)
    {
        return view('tiles.edit',[
            'tile' => $tile,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TileRequest $request, Tiles $tile)
    {
        $data = $request->validated();
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $path = $file->store('uploads/images', 'public');
            $data['logo'] = $path;
        }
        $old_logo = $tile->logo;
        $tile->update($data);

        if($old_logo && $old_logo != $tile->logo){
            Storage::disk('public')->delete($old_logo);
        }
        $tailname = $data['name'];
        Logfile::create([
            'user_id' => Auth::id(),
            'type' => "Update",
            'description' => "Update Tiles that name is  : $tailname ",
        ]);
        // $user->update($data);
        return redirect()->back()
        ->with('success',"Tile ({$tile->name}) Updated!");
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(Tiles $tile)
    // {
    //     $tile->delete();
    //     return redirect()->route('tiles.index')
    //     ->with('success',"Tiles ({$tile->name}) deleted!");
    // }
    // use Illuminate\Http\Request;

public function destroy(Request $request, Tiles $tile)
{
    $tile->delete();
    $tailname = $tile->name;
    Logfile::create([
        'user_id' => Auth::id(),
        'type' => "Delete",
        'description' => "Delete Tiles that name is  : $tailname ",
    ]);
    // if ($request->ajax()) {
        // return response()->json(['success' => "Tiles ({$tile->name}) deleted!"]);
    // }

    return redirect()->route('tiles.index')
        ->with('success', "Tiles ({$tile->name}) deleted!");
}

    // public function trashed(){
    //     $tiles = Tiles::onlyTrashed()->paginate(8);
    //     return view('tiles.trashed',[
    //         'tiles' => $tiles ,
    //     ]);
    // }
    public function restore($id){
        $tile = Tiles::onlyTrashed()->findOrFail($id);
        $tile->restore();
        $tailname = $tile->name;
        Logfile::create([
        'user_id' => Auth::id(),
        'type' => "Restore",
        'description' => "Restore Tiles that name is  : $tailname ",
        ]);
        return redirect()
               ->route('tiles.index')
               ->with('success' , "Tiles ({$tile->name}) restored");

    }
}
