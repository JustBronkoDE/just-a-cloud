<?php

namespace App\Http\Controllers\Chats;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Message;
use App\Chat;
use App\User;
use Auth;

class ChatsController extends Controller
{
	
	/**
	 * Create a new Chat
	 * @param  Request $request [containing chat partner]
	 * @return string $responseMessage
	 */
	public function createChat(Request $request)
	{
    
		$chat = new Chat;

        $members = [
                Auth::user(),
                User::find($request->chatPartner),
        ];

		$responseMessage = $chat->createChat($chat, $members); 
		return $responseMessage;
	}

	/**
	 * Create a new Message
	 * @param  Request $request [containing message and chat_id]
	 * @return void
	 */
    public function newMessage(Request $request)
    {
    	if (!empty($request->message)) {
    		$message = new Message;
    		$message->chat_id = $request->chat;
        	$message->user_id = Auth::user()->id;
        	$message->content = $request->message;

        	$message->addMessage($message);
    	}
    		
        return;
    }

    /**
     * Search for a public User with given string
     * @return array [containing usernames and ids]
     */
    public function searchChatUsers(Request $request)
    {
        $searchResults = User::whereRaw('LOWER(name) LIKE ?', ['%' . $request->search_string . '%'])
                            ->where('public', true)
                            ->get();

        // Pluck name and id from Users
        $searchResults = collect($searchResults)->pluck('name' , 'id');
        
        return $searchResults;
    }

    /**
     * Collects new Messages and Chats and gives them back
     * @param  Request $request [timestamp]
     * @return array           [Chats and messages]
     */
    public function getUpdates(Request $request)
    {

    	$updates = [
            'chats' => $this->getChatUpdates($request->lastUpdate),
            'messages' => $this->getMessageUpdates($request->lastUpdate),
            'user' => Auth::user()->id,
        ];

    	return $updates;
    }

    /**
     * Gets every chat created after a specific time date
     * @param  Request $request 
     * @return Array           [contains new messages]
     */
    private function getMessageUpdates($lastUpdate)
    {
    	$chats = Auth::user()->chats;
    	$newMessages = [];

    	foreach ($chats as $chat) {
    		$messages = $chat->messages()->where('created_at' , '>=' , \Carbon\Carbon::createFromTimestamp($lastUpdate)->toDateTimeString())->get();
            foreach ($messages as $message) {
                array_push($newMessages, $message);
            }
    	}

    	return $newMessages;
    }

    /**
     * Gets every chat created after a specific time date
     * @param  Request $request 
     * @return Array           [contains new chats]
     */
    private function getChatUpdates($lastUpdate)
    {
        //@todo object gets returned we need an array
        $newChats = Auth::user()->chats;

        $newChats = $newChats->where('created_at' , '>=' , \Carbon\Carbon::createFromTimestamp($lastUpdate)->toDateTimeString())->toArray();

        /*if (count($newChats)) {
           $chats = [];
           foreach ($newChats as $chat) {
               array_push($chats, $newChats);
           }
           return $chats;
        }*/

    	return $newChats;
    }

}
