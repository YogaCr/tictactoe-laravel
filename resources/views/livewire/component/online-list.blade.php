<div> 
    
    @if($showOnline)
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
    @if($showAlert)
    <div class="alert alert-{{$alertType}} alert-dismissible fade show" role="alert" style="position: fixed;top:76px;right:0;left:0;">
        {{$alertMessage}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close" wire:click='dismissAlert'>
          <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <div class="online-section">
        <button class="p-3" style="background-color: #343a40;color: white;width:100%" wire:click="setOnlineExpanded">Online ({{sizeof($user_online)}})</button>
        @if($isExpanded)
            <div style="max-height:50vh;overflow-y:auto;">
                <table class="online-list">
                    @foreach($user_online as $u)
                                @if(isset($u['id'])&&isset($u['name']))
                                <tr>
                                    <td class="p-2 pr-3 border-bottom">{{$u['name']}}</td>
                                    <td class="pr-3 pl-3 border-bottom">@if($u['id']!=Auth::user()->id)<button class="badge badge-pill badge-dark" wire:click="ajakOrang({{$u['id']}},'{{$u['name']}}')">Invite</button>@endif</td>
                                </tr>
                                @endif
                                
                            @endforeach    
                </table>
            </div>
        @endif
    </div>

    @section('css')
        <style>
            .online-section{
                background:white;
                min-width:10vw;
                position:fixed;
                bottom:0;
                right:5%;
            }
            .online-list>tbody>tr>td{
                max-width: 24ch;
                text-overflow: ellipsis;
                white-space: nowrap;
                overflow: hidden;
            }
        </style>
    @endsection 
    @endif
</div>
