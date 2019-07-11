<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use App\User;
use Auth;
use File;
use Storage;

class UserController extends Controller
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
     * Edit a users profile
     * @param  User   $user
     * @return View
     */
    public function edit(User $user)
    {
        return view('users.edit')->withUser($user);
    }

    /**
     * Update a users profile
     * @param  Request $request [contains changes]
     * @return Illuminate\Routing\Redirector [Redirect to profile]
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        $picture = $request->file('profile_pic');
        $name = $request->username;
        $desc = $request->description;

        if ($request->profile_public) {
            $public =  true;
        } else {
            $public =  false;
        }

        if ($picture !== null) {
            $user->update([
                'profile_pic' => $picture->storeAs('files/'. Auth::user()->id . '/profile_pic' , 'img.'.$picture->getClientOriginalExtension())
            ]);
        }

        if ($desc !== null && $desc !== '') {
            $user->update([
                'description' => $desc
            ]);
        }

        if ($name !== null && $name !== '') {
            $user->update([
                'name' => $name
            ]);
        }

        if (Auth::user()->public !== $public) {
            $user->update([
                'public' => $public
            ]);
        }

        return redirect('/users/' . Auth::user()->id);
    }

    /**
     * Provides the profile picture of the user
     * @param  User   $user
     * @return Illuminate\Http\Response
     */
    public function downloadImage(User $user)
    {

        //Check if a user is logged in
        if (Auth::user()) {
            $imageExtension = File::extension($user->profile_pic);

            $imageName = Auth::user()->id . '.' . $imageExtension;

            Storage::copy($user->profile_pic, 'temp/' . $imageName);

            return response()->download('storage/temp/' . $imageName)->deleteFileAfterSend(true);
        }
    }
}
