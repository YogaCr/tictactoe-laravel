<div> 
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    @foreach($user_online as $u)
        @if(isset($u['id'])&&isset($u['name']))
            <div wire:click="ajakOrang({{$u['id']}},'{{$u['name']}}')">{{$u['name']}}</div>
        @endif
    @endforeach    
    
    <!-- Modal -->
    @if($showModalPlayer)
    <div class="modal fade show" id="modelId" tabindex="-1" role="dialog" style="display: block">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    Apakah anda yakin ingin mengajak player <strong>{{$name_target}}</strong>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="dismissModalPlayer">Tidak</button>
                    <button type="button" class="btn btn-primary" wire:click="sendRequest">Ya</button>
                </div>
            </div>
        </div>
    </div>
    @endif

    
</div>
