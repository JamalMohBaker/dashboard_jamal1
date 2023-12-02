<?php

namespace App\Http\Controllers;

use App\Models\Logfile as ModelsLogfile;
use Illuminate\Http\Request;

class Logfile extends Controller
{
    public function index(){
        $logfiles = ModelsLogfile::get();

        return view('logfiles.index',[
            'logfiles' => $logfiles,
        ]);

    }

    public function destroy($id)
    {
        $logfile = ModelsLogfile::findOrFail($id);
        $log_id = $logfile->id;
        $log_type = $logfile->type;
        $logfile->delete();
        return redirect()
                ->back()
                ->with('success',"logfile that id ($log_id) and type ($log_type) deleted");
    }
}
