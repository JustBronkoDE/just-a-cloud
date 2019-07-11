<?php

namespace App\Http\Controllers\Cloud;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Crypt;
use App\File;
use Auth;

class CloudController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Adds an instance of a File tp the database
     * @param  Request $request [Data for new file instance]
     * @return Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
    	$this->validate($request, [
    		'files' => 'required',
		]);

        $files = $request->file('files');

        foreach ($files as $file) { 

            // Include file extensions
            include 'libs/file_extensions.php';

            if (isset($imageExtensions[$file->extension()])) {
                $type = 'image';
            } else if (isset($compressedFileExtensions[$file->extension()])) {
                $type = 'compressed_file';
            } else if (isset($codeExtensions[$file->getClientOriginalExtension()])) {
                $type = 'code';
            } else if (isset($audioExtensions[$file->getClientOriginalExtension()])) {
                $type = 'audio';
            } else if (isset($videoExtensions[$file->getClientOriginalExtension()])) {
                $type = 'video';
            } else {
                $type = 'not_supported' . $file->extension();
            }

            $original_name = $file->getClientOriginalName();

            $newFile = new File([
            	'user_id' => Auth::user()->id,
            	'name' => $original_name,
            	'path' => $file->storeAs('files/'. Auth::user()->id, $original_name),
                'type' => $type,
                'public' => false,
            ]);

            // add file to the database and upload it
            $newFile->addFile($newFile);
            Log::info('File: '. $newFile->name . '(' . $newFile->id . ') was added by user: ' . Auth::user()->name. '(' . Auth::user()->id . ')');
        }

    	return back();
    }

    /**
     * Download a File from the Storage
     * @param  File $file
     * @return Illuminate\Http\Response [File]
     */
    public function download(File $file)
    {
        $owner = false;

        //Check if a user is logged in
        if (Auth::user()) {
            //Is the logged in user also the owner?
            $owner = Auth::user()->id === $file->user_id;
        }
        
        //Make file available for owner and if set, for the public.
        if ($file->public || $owner) {
            Storage::copy($file->path, 'temp/' . $file->name);

            Log::info(Auth::user()->name.'('. Auth::user()->id .') '. 'downloaded a file with an id of ' . $file->id . ' named ' . $file->name);

            return response()->download('storage/temp/' . $file->name)->deleteFileAfterSend(true);
        } else {
            return 'Sorry file is not open for public ' . $owner;
        }
    }

    /**
     * Removes a File instance
     * @param  File $file 
     * @return Illuminate\Routing\Redirector
     */
    public function delete(File $file)
    {
        if (Auth::user()->id === $file->user_id) {
            $file->removeFile($file);

            Log::info('File: '. $file->name . '(' . $file->id . ') was removed by user: ' . Auth::user()->name. '(' . Auth::user()->id . ')');

            return redirect('/files');
        }
    }

    /**
     * Toggle File free for Public and private just for owner @todo add Whitelist
     * @param File $file
     * @return void 
     */
    public function togglePublic(File $file)
    {
        if (Auth::user()->id === $file->user_id) {

            $file->public = !$file->public;
            $file->save();

        }
    }
}
