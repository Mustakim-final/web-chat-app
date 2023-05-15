<?php

namespace App\Http\Livewire\Chat;

use App\Models\Conversation;
use App\Models\User;
use Livewire\Component;


class Chatlist extends Component
{
    public $auth_id;
    public $conversations;
    public $reciverInstance;
    public $name;
    public $selectedConversation;

    protected $listeners=['chatUserSelected','refresh'=>'$refresh'];

    public function chatUserSelected(Conversation $conversation,$reciverId)
    {
        //dd($conversation,$reciverId);
        $this->selectedConversation=$conversation;
        $reciverInstance=User::find($reciverId);

        $this->emitTo('chat.chatbox','loadConversation',$this->selectedConversation,$reciverInstance);
        $this->emitTo('chat.send-message','updateSendMessage',$this->selectedConversation,$reciverInstance);
    }

    public function getChatUserInstance(Conversation $conversation,$request)
    {
        $this->auth_id=auth()->id();
        //get selected conversation

        if($conversation->sender_id==$this->auth_id){
            $this->reciverInstance=User::firstWhere('id',$conversation->recever_id);
        }else{
            $this->reciverInstance=User::firstWhere('id',$conversation->sender_id);
        }

        if(isset($request)){
            return $this->reciverInstance->$request;
        }
        # code...
    }

    public function mount()
    {
        $this->auth_id=auth()->id();
        $this->conversations=Conversation::where('sender_id',$this->auth_id)
                              ->orWhere('recever_id',$this->auth_id)->orderBy('last_time_message','DESC')->get();

        //dd($this->conversations);
    }

    public function render()
    {
        return view('livewire.chat.chatlist');
    }
}
