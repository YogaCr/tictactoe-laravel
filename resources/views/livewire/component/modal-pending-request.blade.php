<div>
    <div x-init="Echo.channel('response-req.{{$req_id}}').listen('RequestResponse',(e)=>{console.log(e)})">
        @if($showModalPendingRequest)
                <div class="modal-content" style="position:fixed;bottom:0;width:80vw;margin:auto auto;left: 0;right: 0;">
                    <div class="modal-body">
                        Mengirim permintaan bermain kepada <b>{{$name_to}}</b>, sedang menunggu jawaban
                    </div>
                </div>
            
        @endif
    </div>
    
</div>
