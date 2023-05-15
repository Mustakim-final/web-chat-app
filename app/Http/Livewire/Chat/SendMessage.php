<?php

namespace App\Http\Livewire\Chat;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Livewire\Component;

class SendMessage extends Component
{
    public $slectedConversation;
    public $receverInstance;
    public $body;
    protected $listeners=['updateSendMessage'];

    public function updateSendMessage(Conversation $conversation,User $receiver)
    {
        //dd($conversation,$receiver);
        $this->slectedConversation=$conversation;
        $this->receverInstance=$receiver;
    }

    public function sendMessage()
    {
        //dd($this->body);

        if($this->body==null){
            return null;
        }

        $createdMessage=Message::create([
            'conversations_id'=>$this->slectedConversation->id,
            'sender_id'=>auth()->id(),
            'recever_id'=>$this->receverInstance->id,
            'body'=>$this->body,
        ]);

        $this->slectedConversation->last_time_message=$createdMessage->created_at;
        $this->slectedConversation->save();

        $this->body="";


        $this->emitTo('chat.chatbox','pushMessage',$createdMessage->id);

        //refress chat list message

        $this->emitTo('chat.chatlist','refresh');
    }

    public function render()
    {
        return view('livewire.chat.send-message');
    }
}
