<div>
    {{-- @if($showModalRequest)
            <div class="modal-content" style="position:fixed;bottom:0;width:80vw;margin:auto auto;left: 0;right: 0;">
                <div class="modal-body">
                    Anda menerima permintaan bermain dari <b>{{$name_from}}</b>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" wire:click="rejectRequest">Tolak</button>
                    <button type="button" class="btn btn-success" wire:click="acceptRequest">Terima</button>
                </div>
            </div>
        
    @endif --}}
    <div class="card text-center rounded mt-0" style="background-image:url('{{asset('/img/card2.jpg')}}');" >
        <div class="card-body">
          <div class="row g-0">
            <div class="col-12">
              <h1 class="font-weight-bold" style="font-size:1.5rem;color:black">Permintaan Masuk</h1>
              <div  style=" max-height:100vh;overflow-y:auto">
              <table class="table">
                <thead>
                  
                    <tr>
                      <th>Nama</th><th>Aksi</th>
                    </tr>
                  
                </thead>
                <tbody>
                    @foreach($req_list as $r)
                    <tr>
                        <td style="max-width: 24ch;
                        text-overflow: ellipsis;
                        white-space: nowrap;
                        overflow: hidden;" >{{$r->From->name}}</td><td><button type="button" class="badge badge-danger" wire:click="$emit('rejectRequest',{{$r->id}})">Tolak</button>
                            <button type="button" class="badge badge-success" wire:click="$emit('acceptRequest',{{$r->id}})">Terima</button></td>
                    </tr>
                    @endforeach 
                </tbody>
              </table>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>
