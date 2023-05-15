<div>
    {{-- Care about people's approval and you will be their prisoner. --}}

    <div class="chatlist_header">
        <div class="title">
            Chat
        </div>
        <div class="img_container">
            <img style="width:100%; height:100%; border-radius:50%; border:1px solid gray"
                src="https://ui-avatars.com/api/?background=0D8ABC&color=fff&name={{ auth()->user()->name }}" alt="">


        </div>
    </div>

    @if (count($conversations) > 0)

        @foreach ($conversations as $row)
            <div class="chatlist_body" wire:key='{{ $row->id }}' wire:click="$emit('chatUserSelected',{{ $row }},{{ $this->getChatUserInstance($row,$name='id') }})">

                <div class="chatlist_item">
                    <div class="chatlist_img_container">
                        <img src="https://ui-avatars.com/api/?name={{ $this->getChatUserInstance($row,$name='name') }}" alt="">
                    </div>

                    <div class="chatlist_info">
                        <div class="top_row">
                            <div class="list_username">
                                {{ $this->getChatUserInstance($row,$name='name') }}
                            </div>

                            {{-- <span class="date">{{ $row->messages->last()?->created_at->shortAbsolutedDiffForHuman }}</span> --}}
                        </div>

                        <div class="bottom_row">
                            <div class="message_body text-truncate">
                                {{-- {{ $row->messages->last()->body }} --}}

                            </div>

                            <div class="unread_count">
                                56
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        no conversation
    @endif


</div>
