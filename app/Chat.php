<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Exception;

class Chat extends Model
{
	/**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [];

    /**
     * Create a new chat and add the members
     * @param Chat $chat
     * @param [User] $members
     * @return void
     */
    public function createChat(Chat $chat, array $members)
    {
        try {
            $chat->save();

            // Attach/Add chat members
            foreach ($members as $member) {
                $this->users()->attach($member->id);
            }

            return 'success';
        } catch (Exception $exception) {
            // Probably a duplicate (existing chat)
            return 'Database error! ' . $exception->getCode();
        }
        
    }

    /**
     * Returns all the messages of the given chat
     * @return Relationship [Chat has many Messages, 1:n]
     */
    public function messages()
    {
    	return $this->hasMany(Message::class);
    }

    /**
     * Returns all the users of the given chat
     * @return Relationship [Chat has many Users, n:m]
     */
    public function users()
    {
    	return $this->belongsToMany(User::class);
    }

    /**
     * Returns users of a chat without the authenticated user 
     * @return [type] [description]
     */
    public function getMembers()
    {
        $members = $this->users()->where('id', '!=' , Auth::user()->id)->get();

        return $members;
    }
}
