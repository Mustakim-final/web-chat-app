<?php

namespace App\Http\Livewire\Chat;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Livewire\Component;

class CreateChat extends Component


{

    public $message='How are you';

    public function checkconversation($receivedId)
    {
        //dd($receivedId);
        $checkConversation=Conversation::where('recever_id',auth()->user()->id)->where('sender_id',$receivedId)->orWhere('recever_id',$receivedId)->where('sender_id',auth()->user()->id)->get();

        if(count($checkConversation)==0){

            //,'last_time_message'=>0
            $createdConvsersation=Conversation::create(['recever_id'=>$receivedId,'sender_id'=>auth()->user()->id,'last_time_message'=>0]);

            $createdMessage=Message::create(['conversations_id'=>$createdConvsersation->id,'sender_id'=>auth()->user()->id,'recever_id'=>$receivedId,'body'=>$this->message]);

            $createdConvsersation->last_time_message=$createdMessage->created_at;
            $createdConvsersation->save();

            //dd('save');
            //dd($createdMessage);


            //dd('no conversation');
        }elseif(count($checkConversation)>=1){
            dd('conversation');
        }
    }

    public function render()
    {
        $user=User::where('id','!=',auth()->user()->id)->get();
        //dd($user);
        return view('livewire.chat.create-chat',compact('user'));
    }
}
