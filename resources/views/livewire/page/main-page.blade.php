@if(Auth::check())

          <div class="container">
            <div class="row">
              <div class="col-md-6 p-3">
                <div class=" card text-center mt-0 rounded" style="background-image:url('{{asset('/img/card2.jpg')}}');" >
                <div class="card-body">
                  <div class="row g-0">
                    <div class="col-md-6 d-flex flex-column align-items-center">
                      <img class="img img-fluid" src="{{asset('/img/logo.png')}}" alt="" width="225" height="225">
                    </div>
                    <div class="col-md-6 pt-3 d-flex flex-column justify-content-center">
                        <h1 class="font-weight-bold" style="font-size:1.5rem;color:black">TicTacToe</h1>
                        {{-- <a href="#" class="btn btn-primary mt-3 rounded-pill" style="background-color:#000000">Find opponent</a> --}}
                        <a href="{{url('/user')}}" class="btn btn-primary rounded-pill mt-3" style="background-color:#000000">Lihat Profil</a>
                        <a href="javascript:void(0)" onclick="$('#logout').click()" class="btn btn-primary rounded-pill mt-3" style="background-color:#000000">Logout</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 p-3">
                @livewire('component.table-request-list')
                @livewire('component.table-game-list')
              </div>
            </div>
          </div>
      @livewire('component.online-list',['showOnline'=>true])
      {{-- @livewire('component.modal-pending-request')
      @livewire('component.modal-has-game') --}}


@else
<div class="container d-flex justify-content-center">
    <div class="card text-center rounded" style="width:  18rem; margin: auto;">
        <img src="{{asset('/img/logo.png')}}" class="card-img-top img img-fluid" alt="" style="background-image:url({{asset('/img/card2.jpg')}});">
        <div class="card-body" style="background-image:url({{asset('/img/card2.jpg')}})">
          <h5 class="card-title">Let's play TicTacToe!</h5>
          <p class="card-text">Find your TicTacToe partner here!</p>
          <a href="{{route('login')}}" class="btn btn-primary rounded-pill mt-2" style="background-color:#000000">Play</a>
        </div>
    </div>
</div>
@endif