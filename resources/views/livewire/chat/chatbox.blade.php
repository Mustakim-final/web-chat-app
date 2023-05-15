<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}

    @if ($selectedConversation)

    <div class="chatbox_header">


        <div class="return">
            <i class="bi bi-arrow-left"></i>
        </div>

        <div class="img_container">
            <img src="https://ui-avatars.com/api/?name={{ $reciverInstance->name }}" alt="">
        </div>

        <div class="name">
            {{ $reciverInstance->name }}
        </div>

        <div class="info">
            <div class="info_item">
                <i class="bi bi-telephone-fill"></i>
            </div>

            <div class="info_item">
                <i class="bi bi-image"></i>
            </div>

            <div class="info_item">
                <i class="bi bi-info-square-fill"></i>
            </div>
        </div>
    </div>

    <div class="chatbox_body">

        @foreach ($messages as $row)
        <div class="msg_body {{ auth()->id()==$row->sender_id? 'msg_body_me':'msg_body_receiver' }}">
            {{ $row->body }}
            <div class="msg_body_footer">
                <div class="date">
                    {{ $row->created_at->format('m: i a') }}
                </div>

                <div class="read">
                    <i class="bi bi-check"></i>
                </div>
            </div>
        </div>
        @endforeach











    </div>

    <script>
        $('.chatbox_body').on('scroll',function(){
            var top=$('.chatbox_body').scrollTop();

            if(top==0){
                window.livewire.emit('loadmore');
            }
        })
    </script>

    <script>
        window.addEventListener('updateHeight',event=>{
            let old=event.detail.height;
            let newHeight=$('.chatbox_body')[0].scrollHeight;

            let height=$('.chatbox_body').scrollTop(newHeight-old);
            window.livewire.emit('updateHeight',{
                height:height,
            })
        });
    </script>

    @else
    <div class="fs-4 text-center text-primary mt-5">
        no conversation selected
    </div>
    @endif






    <script>
        window.addEventListener('rowChatToBottom',event=>{
            $('.chatbox_body').scrollTop($('.chatbox_body')[0].scrollHeight);
        });

    </script>

</div>

{{-- <div class="msg_body msg_body_me">
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus tempore non dolor aspernatur repellat beatae voluptatum. Error harum provident, laborum corporis eligendi dicta a maiores fugit obcaecati. Doloribus, animi quibusdam.
    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quisquam aliquid culpa quam qui placeat dolores id vero at facere quo! Nostrum dolorem quisquam, reprehenderit natus quia sit at minus voluptas.

    <div class="msg_body_footer">
        <div class="date">
            5 hours ago
        </div>

        <div class="read">
            <i class="bi bi-check"></i>
        </div>
    </div>
</div> --}}
