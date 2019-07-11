<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\File;
use Auth;
use App\User;

class PageController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $files = File::where('user_id', Auth::user()->id)->get();
        $publicFiles = File::where('user_id', Auth::user()->id)->where('public', true)->get();
        $users = User::where('public', true)->orderBy('name')->get();

        return view('dashboard')->withFiles($files)->withUsers($users)->withPublicFiles($publicFiles);
    }

    /**
     * Show the files dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function files()
    {
        $files = File::where('user_id', Auth::user()->id)->orderBy('type')->get();
        return view('files.files')->withFiles($files);
    }

    /**
     * Detail View of a file
     * @param  File   $file ID of file
     * @return \Illuminate\Http\Response
     */
    public function file(File $file)
    {   
        //Retrieve File 
        $code = \Illuminate\Support\Facades\File::get('storage/' . $file->path);

        //Encode File in HTML-encoded
        $code = htmlentities(mb_convert_encoding($code, 'UTF-8', 'ASCII'), ENT_SUBSTITUTE, "UTF-8");

        return view('files.file')->withFile($file)->withCode($code);
    }

    /**
     * Show all registered public users
     * @return \Illuminate\Http\Response
     */
    public function users()
    {
        $users = User::where('public', true)->orderBy('name')->get();

        $publicCount = count(File::where('public', true)->get());
        return view('users.users')->withUsers($users)->withPublicCount($publicCount);
    }

    /**
     * Show a users profile
     * @return \Illuminate\Http\Response
     */
    public function user($userId)
    {   
        $user = User::find($userId);
        
        if ($user) {

            $files = File::where('user_id', $user->id)->where('public', true)->orderBy('type')->get();
            return view('users.user')->withUser($user)->withFiles($files);
        } else {
            return abort(404);
        }
    }

}
