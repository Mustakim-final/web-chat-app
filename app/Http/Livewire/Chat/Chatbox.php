<?php

namespace App\Http\Livewire\Chat;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Livewire\Component;

class Chatbox extends Component
{

    public $reciverInstance;
    public $selectedConversation;
    public $message_count;
    public $receiver;
    public $messages;
    public $paginateVar=10;
    protected $listeners=['loadConversation'];

    public function loadConversation(Conversation $conversation,User $receiver)
    {
        //dd($conversation,$receiver);

        $this->selectedConversation=$conversation;
        $this->reciverInstance=$receiver;

        $this->message_count=Message::where('conversations_id',$this->selectedConversation->id)->count();

        $this->messages=Message::where('conversations_id',$this->selectedConversation->id)
                       ->skip($this->message_count-$this->paginateVar)
                       ->take($this->paginateVar)->get();

        $this->dispatchBrowserEvent('chatSelected');

        //$this->messages=Message::where('conversations_id',$this);

        //dd($this->messages);

    }

    public function render()
    {
        return view('livewire.chat.chatbox');
    }
}
