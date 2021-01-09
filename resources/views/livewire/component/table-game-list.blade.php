<div>
        {{-- @if($showModalHasGame)
                <div class="modal-content" style="position:fixed;bottom:0;width:80vw;margin:auto auto;left: 0;right: 0;">
                    <div class="modal-body">
                        Anda masih memiliki permainan yang belum selesai
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" wire:click="cancelGame">Berhenti</button>
                        <button type="button" class="btn btn-success" wire:click="goToGame">Lanjutkan</button>
                    </div>
                </div>
            
        @endif --}}
        <div class="card text-center rounded mt-3" style="background-image:url('{{asset('/img/card2.jpg')}}');" >
            <div class="card-body">
              <div class="row g-0">
                <div class="col-12">
                  <h1 class="font-weight-bold" style="font-size:1.5rem;color:black">Daftar Permainan</h1>
                  <div  style=" max-height:100vh;overflow-y:auto">
                  <table class="table">
                    <thead>
                      
                        <tr>
                          <th>Nama Lawan</th><th>Aksi</th>
                        </tr>
                      
                    </thead>
                    <tbody>
                        @foreach($match_list as $m)
                        <tr>
                            <td style="max-width: 24ch;
                            text-overflow: ellipsis;
                            white-space: nowrap;
                            overflow: hidden;" >{{($m->user_id_1==Auth::user()->id?$m->SecondPlayer->name:$m->FirstPlayer->name)}}</td><td><button type="button" class="badge badge-success" wire:click="$emit('goToGame',{{$m->id}})">Main</button></td>
                        </tr>
                        @endforeach 
                    </tbody>
                  </table>
                  </div>
                </div>
              </div>
            </div>
</div>
