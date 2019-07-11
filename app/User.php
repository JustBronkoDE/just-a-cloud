<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'api_token',
        'profile_pic',
        'description',
        'public',
    ];

    /**
     * The attributes that are hidden in arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'api_token',
        'public',
    ];

    /**
     * Get the files associated with the given user
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function files()
    {
        return $this->hasMany(File::class);
    }

    /**
     * Get the messages associated with the given user
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    /**
     * Get the chats associated with the given user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function chats()
    {
        return $this->belongsToMany(Chat::class);
    }

    /**
     * Add a new profile picture to the given user
     * @param File $image
     */
    public function addProfilePic($image)
    {
        $this->profile_pic = $this->storeAs('files/' . Auth::user()->id . '/' . $image->getClientOriginalName());
    }

    /**
     * Returns all public Files of User
     * @return [Files]
     */
    public function publicFiles()
    {
        return File::where('user_id', $this->id)->where('public', true)->get();
    }

    /**
     * Returns the path of the user profile picture
     * @return string [path]
     */
    public function getProfilePic()
    {
        if (strpos($this->profile_pic, 'defaults') !== false) {
            return $this->profile_pic;
        } else {
            return '/users/' . $this->id . '/profile/image';
        }
    }
}
