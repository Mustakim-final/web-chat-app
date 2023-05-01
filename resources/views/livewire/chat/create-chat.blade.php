<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
   <ul class="list-group w-75 mx-auto mt-3 container-fluid">

    @foreach ($user as $row)
    <li class="list-group-item list-group-item-action" wire:click='checkconversation({{ $row->id }})'>{{ $row->name }}</li>
    @endforeach


   </ul>

</div>
