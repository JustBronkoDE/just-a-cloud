<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'chat_id',
        'owner_id',
        'content',
    ];

    /**
     * Relationship between Message and Chat
     * @return Relationship [Message belongs to a Chat]
     */
    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }

    /**
     * Relationship between Message and User
     * @return Relationship [Message belongs to Owner]
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Save Message to Database
     * @return void 
     */
    public function addMessage($message)
    {
        $message->save();
    }
}
