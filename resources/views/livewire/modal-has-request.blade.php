<div>
    @if($showModalRequest)
            <div class="modal-content" style="position:fixed;bottom:0;width:80vw;margin:auto auto;left: 0;right: 0;">
                <div class="modal-body">
                    Anda menerima permintaan bermain dari <b>{{$name_from}}</b>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" wire:click="rejectRequest">Tolak</button>
                    <button type="button" class="btn btn-success" wire:click="acceptRequest">Terima</button>
                </div>
            </div>
        
    @endif
</div>
