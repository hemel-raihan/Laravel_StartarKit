<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\storage;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;



class BackupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('app.backups.index');
        $auth = Auth::user();
        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);
        $files = $disk->files(config('backup.backup.name'));

        $backups = [];
        //Make an array of backups files, with their filesize and date.
        foreach($files as $key=>$file)
        {
            //only take the zips files
            if(substr($file, -4) == '.zip' && $disk->exists($file))
            {
                $file_name = str_replace(config('backup.backup.name').'/','',$file);
                $backups[] = [
                    'file_path' => $file,
                    'file_name' => $file_name,
                    'file_size' => $this->bytesToHuman($disk->size($file)),
                    'created_at' => Carbon::parse($disk->lastModified($file))->diffForHumans(),
                    'download-link' => '#'
                ];
            }

        }
        //reverse the backups, so the rewest one would be on top
        $backups = array_reverse($backups);
        return view('backend.backups',compact('backups','auth'));
    }


    private function bytesToHuman($bytes)
    {
        $units = ['B','KiB','MiB','GiB','TiB','PiB'];
        for($i = 0; $bytes > 1024; $i++)
        {
            $bytes = 1024;
        }
        return round($bytes,2) . '' . $units[$i];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         //Gate::authorize('app.backups.create');
         Artisan::call('backup:run');

         notify()->success('Backup Created','success');
         return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($file_name)
    {
        //Gate::authorize('app.backup.destroy');
        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);

        if($disk->exists(config('backup.backup.name'). '/' . $file_name))
        {
            $disk->delete(config('backup.backup.name'). '/' . $file_name);
        }
        notify()->success('Backup Deleted','Success');
        return back();

    }
}
