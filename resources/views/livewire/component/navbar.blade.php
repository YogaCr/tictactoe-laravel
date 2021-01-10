{{-- <nav class="navbar navbar-expand-lg navbar-light mb-5 rounded" style="background: rgb(224,167,0);
background: linear-gradient(90deg, rgba(224,167,0,1) 0%, rgba(232,103,1,1) 100%);"> 
    <div class="container">
      <a class="navbar-brand d-flex align-items-center" href="#">
        <img src="{{asset('/img/logo.png')}}" alt="" width="35" height="35" class="d-inline-block align-top"><span class="ml-2" style="font-weight:bold;">
        TicTacToe</span>
      </a> 
      <a href="{{route('login')}}" class="btn btn-outline-dark rounded-pill" style="background-image:url({{asset('/img/card2.jpg')}});" style="margin-left:85%">Login</a>
    </div>
  </nav>
   --}}
   <nav class="navbar navbar-expand-lg navbar-light mb-5 rounded" style="background: rgb(224,167,0);background: linear-gradient(90deg, rgba(224,167,0,1) 0%, rgba(232,103,1,1) 100%);">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{url('/')}}">
            <img src="{{asset('/img/logo.png')}}" alt="" width="35" height="35" class="d-inline-block align-top"><span class="ml-2" style="font-weight:bold;">
            TicTacToe</span>
          </a> 
        {{-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> --}}
        {{-- <span class="navbar-toggler-icon"></span> --}}
        </button>
    
            @if(Auth::check())
            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

              {{-- <!-- Nav Item - Alerts -->
              <li class="nav-item dropdown no-arrow mx-1">
                  <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-bell fa-fw"></i>
                      <!-- Counter - Alerts -->
                      <span class="badge badge-danger badge-counter">3+</span>
                  </a>
                  <!-- Dropdown - Alerts -->
                  <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                      aria-labelledby="alertsDropdown">
                      <h6 class="dropdown-header">
                          Alerts Center
                      </h6>
                      <a class="dropdown-item d-flex align-items-center" href="#">
                          <div class="mr-3">
                              <div class="icon-circle bg-primary">
                                  <i class="fas fa-file-alt text-white"></i>
                              </div>
                          </div>
                          <div>
                              <div class="small text-gray-500">December 12, 2019</div>
                              <span class="font-weight-bold">A new monthly report is ready to download!</span>
                          </div>
                      </a>
                      <a class="dropdown-item d-flex align-items-center" href="#">
                          <div class="mr-3">
                              <div class="icon-circle bg-success">
                                  <i class="fas fa-donate text-white"></i>
                              </div>
                          </div>
                          <div>
                              <div class="small text-gray-500">December 7, 2019</div>
                              $290.29 has been deposited into your account!
                          </div>
                      </a>
                      <a class="dropdown-item d-flex align-items-center" href="#">
                          <div class="mr-3">
                              <div class="icon-circle bg-warning">
                                  <i class="fas fa-exclamation-triangle text-white"></i>
                              </div>
                          </div>
                          <div>
                              <div class="small text-gray-500">December 2, 2019</div>
                              Spending Alert: We've noticed unusually high spending for your account.
                          </div>
                      </a>
                      <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                  </div>
              </li>

              <!-- Nav Item - Messages -->
              <li class="nav-item dropdown no-arrow mx-1">
                  <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-envelope fa-fw"></i>
                      <!-- Counter - Messages -->
                      <span class="badge badge-danger badge-counter">7</span>
                  </a>
                  <!-- Dropdown - Messages -->
                  <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                      aria-labelledby="messagesDropdown">
                      <h6 class="dropdown-header">
                          Message Center
                      </h6>
                      <a class="dropdown-item d-flex align-items-center" href="#">
                          <div class="dropdown-list-image mr-3">
                              <img class="rounded-circle" src="img/undraw_profile_1.svg"
                                  alt="">
                              <div class="status-indicator bg-success"></div>
                          </div>
                          <div class="font-weight-bold">
                              <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                  problem I've been having.</div>
                              <div class="small text-gray-500">Emily Fowler · 58m</div>
                          </div>
                      </a>
                      <a class="dropdown-item d-flex align-items-center" href="#">
                          <div class="dropdown-list-image mr-3">
                              <img class="rounded-circle" src="img/undraw_profile_2.svg"
                                  alt="">
                              <div class="status-indicator"></div>
                          </div>
                          <div>
                              <div class="text-truncate">I have the photos that you ordered last month, how
                                  would you like them sent to you?</div>
                              <div class="small text-gray-500">Jae Chun · 1d</div>
                          </div>
                      </a>
                      <a class="dropdown-item d-flex align-items-center" href="#">
                          <div class="dropdown-list-image mr-3">
                              <img class="rounded-circle" src="img/undraw_profile_3.svg"
                                  alt="">
                              <div class="status-indicator bg-warning"></div>
                          </div>
                          <div>
                              <div class="text-truncate">Last month's report looks great, I am very happy with
                                  the progress so far, keep up the good work!</div>
                              <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                          </div>
                      </a>
                      <a class="dropdown-item d-flex align-items-center" href="#">
                          <div class="dropdown-list-image mr-3">
                              <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                                  alt="">
                              <div class="status-indicator bg-success"></div>
                          </div>
                          <div>
                              <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                  told me that people say this to all dogs, even if they aren't good...</div>
                              <div class="small text-gray-500">Chicken the Dog · 2w</div>
                          </div>
                      </a>
                      <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                  </div>
              </li>

              <div class="topbar-divider d-none d-sm-block"></div> --}}

              <!-- Nav Item - User Information -->
              <li class="nav-item dropdown no-arrow">
              
                <a class="nav-link dropdown d-flex flex-row align-items-center" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <img class="h-10 w-10 rounded-full" style="object-fit: cover;" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                    <span class="font-profile ml-2 d-none d-lg-inline
                ">Hi, {{ Auth::user()->name }}</span>
                
                
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                    aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="{{url('/user')}}">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        Profile
                    </a>
  
                    <form method="POST" action="{{ route('logout') }}">
                      @csrf
  
                      <a class="dropdown-item" href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                      this.closest('form').submit();" id="logout">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                      </a>
                  </form>
                    
                </li>

          </ul>
            
            
          
            {{-- <ul class="navbar-nav">
                <img class="h-10 w-10 rounded-full" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="#">{{ Auth::user()->name }}</a>
                </li>
              </ul> --}}
              @else
              <a href="{{route('login')}}" class="btn btn-outline-dark rounded-pill" style="background-image:url({{asset('/img/card2.jpg')}});" style="margin-left:85%">Login</a>
              @endif
        </div>
    </div>
  </nav>