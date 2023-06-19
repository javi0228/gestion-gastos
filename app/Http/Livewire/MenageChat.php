<?php

namespace App\Http\Livewire;

use Auth;
use Livewire\Component;

class MenageChat extends Component
{

    /**
     * Chat users
     */
    public $users;
    /**
     * Chat's menage
     */
    public $menage;
    /**
     * List of received messages in the chat
     */
    public $receivedMessages;
    /**
     * List of sent messages in the chat
     */
    public $sentMessages;
    /**
     * Chat instance
     */
    public $chat;
    /**
     * Message to send
     */
    public $message;

    public function mount($menage)
    {
        // Get menage of the chat and users from menage
        $this->menage = $menage;
        $this->users = $this->menage->users;
        $this->chat = $this->menage->chat;
        $this->getMessages();
    }

    /**
     * Get all the chat messages
     */
    public function getMessages()
    {
        // Get received and sent messages
        $this->receivedMessages = $this->menage->chat->messages()->where('user_id', '!=', Auth::user()->id)->get();
        $this->sentMessages = $this->menage->chat->messages()->where('user_id', '=', Auth::user()->id)->get();
    }

    public function render()
    {
        return view('livewire.menage-chat');
    }

    public function sendMessage()
    {
        if ($this->message) {
            $this->chat->messages()->create([
                'user_id' => Auth::user()->id,
                'message' => $this->message
            ]);

            unset($this->message);
        }
    }
}