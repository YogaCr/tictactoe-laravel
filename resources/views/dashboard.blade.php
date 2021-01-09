<x-app-layout>

    <div class="container">
        <div class="row">
          <div class="col-sm-8"> 
              <main class="ml-md-5 pl-md-5">
                <div class="card text-center d-flex justify-content-center rounded pt-3 pb-3 m-0" style="background-image:url('{{asset('/img/card2.jpg')}}');" >
                  <div class="row g-0">
                    <div class="col-md-6">
                      <img class="ml-5 img img-fluid" src="{{asset('/img/logo.png')}}" alt="" width="225" height="225">
                    </div>
                    <div class="col-md-5">
                      <div class="card-body">
                        <h5 class="card-title mb-2">TicTacToe</h5>
                        <a href="#" class="btn btn-primary mt-3 rounded-pill" style="background-color:#000000">Find opponent</a>
                        <br/>
                        <a href="#" class="btn btn-primary mt-3 rounded-pill" style="background-color:#000000">Logout</a>
                      </div>
                    </div>
                  </div>
                </div>
              </main>
          </div>
          <div class="col-sm-4">
              @livewire('online-list')
            </div>
          </div>
        </div>
        @livewire('modal-pending-request')
        @livewire('modal-has-request')
</x-app-layout>
