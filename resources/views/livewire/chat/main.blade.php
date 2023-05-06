<div>
    {{-- The best athlete wants his opponent at his best. --}}


    <div class="chat_container">
        <div class="chat_list_container">

            @livewire('chat.chatlist')
        </div>
        <div class="chat_box_container">
            @livewire('chat.chatbox')

            @livewire('chat.send-message')
        </div>
    </div>

    <script>
        window.addEventListener('chatSelected',event=>{
            if(window.innerWidth<768){
                $('.chat_list_container').hide();
                $('.chat_list_container').show();
            }
        });

        $(window).resize(function(){
            if(window.innerWidth>768){
                $('.chat_list_container').show();
                $('.chat_list_container').show();
            }
        });

        $(document).on('click','return',function(){
            $('.chat_list_container').show();
            $('.chat_list_container').hide();
        });
    </script>
</div>
