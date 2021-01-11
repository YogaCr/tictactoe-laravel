<div class="pb-5">
    
    <h1 class="font-semibold text-xl text-warning leading-tight text-center">
        @if($is_playing)
            Giliran {{$turn_now==1?$player_1->name:$player_2->name}}
        @endif
        @if(!$is_playing)
            @if(!$is_leaving)
                @if($this->match->status=='rematch_request')
                    @if($this->match->rematch_request_from==Auth::user()->id)
                        <center><h1 style="color:white;font-size:1.5rem;font-weight:bold">Menunggu balasan dari lawan</h1></center>
                    @else
                        <center><h1 style="color:white;font-size:1.5rem;font-weight:bold">{{$this->match->RematchFrom->name}} mengajak tanding ulang</h1></center>
                    @endif
                @endif
                @if(sizeof($this->player_list)>1)<center><button type="button" class="btn btn-light font-weight-bold" wire:click="$emit('mainLagi')">Main Lagi?</button></center>@endif
            @else
                <center><h1 style="color:white;font-size:1.5rem;font-weight:bold">{{$leave_name}} telah keluar dari room.</h1></center>
            @endif
                <center><a href="{{ url('/') }}" type="button" class="btn btn-danger font-weight-bold mt-3" >Kembali Ke Home</a></center>
        @endif
    </h1>
    {{-- <div class="d-flex justify-content-center text-center ">
        <div class="play-board m-4">
            <table class="m-4">
                    <thead>
                        <tr>
                            <th scope="col" class="border-1">
                                <button type="button" class="field  text-white" wire:click="$emit('clickField',1)" {{$is_playing?'':'disabled'}}><h1 style="font-size:10rem"><center>{{$board[0][0]=='#'?' ':$board[0][0]}}</center></h1></button>
                            </th>
                            <th scope="col" class=""><button type="button" class="field  text-white" wire:click="$emit('clickField',2)" {{$is_playing?'':'disabled'}}><h1 style="font-size:10rem"><center>{{$board[0][1]=='#'?' ':$board[0][1]}}</center></h1></button></th>
                            <th scope="col" class="border-3"><button type="button" class="field  text-white" wire:click="$emit('clickField',3)" {{$is_playing?'':'disabled'}}><h1 style="font-size:10rem"><center>{{$board[0][2]=='#'?' ':$board[0][2]}}</center></h1></button>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row" class=""><button type="button" class="field  text-white" wire:click="$emit('clickField',4)" {{$is_playing?'':'disabled'}}><h1 style="font-size:10rem"><center>{{$board[1][0]=='#'?' ':$board[1][0]}}</center></h1></button>
                            </th>
                            <td class="border-5"><button type="button" class="field  text-white" wire:click="$emit('clickField',5)" {{$is_playing?'':'disabled'}}><h1 style="font-size:10rem"><center>{{$board[1][1]=='#'?' ':$board[1][1]}}</center></h1></button>
                            </td>
                            <td class=""><button type="button" class="field  text-white" wire:click="$emit('clickField',6)" {{$is_playing?'':'disabled'}}><h1 style="font-size:10rem"><center>{{$board[1][2]=='#'?' ':$board[1][2]}}</center></h1></button>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row" class="border-7"><button type="button" class="field  text-white" wire:click="$emit('clickField',7)" {{$is_playing?'':'disabled'}}><h1 style="font-size:10rem"><center>{{$board[2][0]=='#'?' ':$board[2][0]}}</center></h1></button>
                            </th>
                            <td class=""><button type="button" class="field  text-white" wire:click="$emit('clickField',8)" {{$is_playing?'':'disabled'}}><h1 style="font-size:10rem"><center>{{$board[2][1]=='#'?' ':$board[2][1]}}</center></h1></button>
                            </td>
                            <td class="border-9"><button type="button" class="field  text-white" wire:click="$emit('clickField',9)" {{$is_playing?'':'disabled'}}><h1 style="font-size:10rem"><center>{{$board[2][2]=='#'?' ':$board[2][2]}}</center></h1></button></td>
                        </tr>
                    </tbody>
            </table>
        </div>
    </div> --}}
    <div class="mt-4 d-flex justify-content-center">
        <div class="d-inline-flex flex-column">
            <div class="d-inline-flex">
                <div class="field" style="border-right: 5px solid mediumspringgreen;border-bottom: 5px solid mediumspringgreen;" wire:click="$emit('clickField',1)">
                    <button class="content" {{$is_playing?'':'disabled'}}>
                        <h1><center>{{$board[0][0]=='#'?' ':$board[0][0]}}</center></h1>
                    </button>
                </div>
                <div class="field" style="border-bottom: 5px solid mediumspringgreen;" wire:click="$emit('clickField',2)">
                    <button class="content" {{$is_playing?'':'disabled'}}>
                        <h1><center>{{$board[0][1]=='#'?' ':$board[0][1]}}</center></h1>
                    </button>
                </div>
                <div class="field" style="border-left: 5px solid mediumspringgreen;border-bottom: 5px solid mediumspringgreen;" wire:click="$emit('clickField',3)">
                    <button class="content" {{$is_playing?'':'disabled'}}>
                        <h1><center>{{$board[0][2]=='#'?' ':$board[0][2]}}</center></h1>
                    </button>
                </div>
            </div>
            <div class="d-inline-flex">
                <div class="field" style="border-right: 5px solid mediumspringgreen;" wire:click="$emit('clickField',4)">
                    <button class="content" {{$is_playing?'':'disabled'}}>
                        <h1><center>{{$board[1][0]=='#'?' ':$board[1][0]}}</center></h1>
                    </button>
                </div>
                <div class="field" wire:click="$emit('clickField',5)">
                    <button class="content" {{$is_playing?'':'disabled'}}>
                        <h1><center>{{$board[1][1]=='#'?' ':$board[1][1]}}</center></h1>
                    </button>
                </div>
                <div class="field" style="border-left: 5px solid mediumspringgreen;" wire:click="$emit('clickField',6)">
                    <button class="content" {{$is_playing?'':'disabled'}}>
                        <h1><center>{{$board[1][2]=='#'?' ':$board[1][2]}}</center></h1>
                    </button>
                </div>
            </div>
            <div class="d-inline-flex">
                <div class="field" style="border-right: 5px solid mediumspringgreen;border-top: 5px solid mediumspringgreen;" wire:click="$emit('clickField',7)">
                    <button class="content" {{$is_playing?'':'disabled'}}>
                        <h1><center>{{$board[2][0]=='#'?' ':$board[2][0]}}</center></h1>
                    </button>
                </div>
                <div class="field" style="border-top: 5px solid mediumspringgreen;" wire:click="$emit('clickField',8)">
                    <button class="content" {{$is_playing?'':'disabled'}}>
                        <h1><center>{{$board[2][1]=='#'?' ':$board[2][1]}}</center></h1>
                    </button>
                </div>
                <div class="field" style="border-left: 5px solid mediumspringgreen;border-top: 5px solid mediumspringgreen;" wire:click="$emit('clickField',9)">
                    <button class="content" {{$is_playing?'':'disabled'}}>
                        <h1><center>{{$board[2][2]=='#'?' ':$board[2][2]}}</center></h1>
                    </button>
                </div>
            </div>
        </div>
    </div>
        @if(!$is_playing)
            @if($is_draw)
            <div class=" mt-4 bg-warning d-flex justify-content-center mb-2 container  rounded col-xs-8 col-md-5 col-lg-4 p-2">
                <div class=" greets text-uppercase">
                    <h3 class="text-center">Pertandingan Seri</h3>
                </div>
            </div>
            @else
                @if($winner)
                    @if($winner->id==Auth::user()->id)
                    <div class=" mt-4 bg-success d-flex justify-content-center mb-2 container  rounded col-xs-8 col-md-5 col-lg-4 p-2">
                        <div class=" greets text-uppercase">
                            <h3 class="text-center">Selamat anda menang!</h3> <!-- nek menang ijo nek kalah abang-->
                        </div>
                    </div>
                    @else
                    <div class=" mt-4 bg-danger d-flex justify-content-center mb-2 container  rounded col-xs-8 col-md-5 col-lg-4 p-2">
                        <div class=" greets text-uppercase">
                            <h3 class="text-center">Yah anda kalah</h3>
                        </div>
                    </div>
                    @endif
                @endif
            @endif
            
        @endif
        <div class="footer d-flex flex-row justify-content-center align-items-center">
            <div class="d-flex flex-column flex-sm-row align-items-center">
                <img class="h-10 w-10 rounded-full mr-2" style="object-fit: cover;" src="{{ $player_1->profile_photo_url }}" alt="{{ $player_1->name }}" /><span style="font-size:1.5rem">{{$player_1->name}}</span>
            </div>
            <h1 style="font-size:3rem;font-weight:bold" class="ml-3 mr-3">VS</h1>
            <div class="d-flex flex-column-reverse flex-sm-row align-items-center">
                <span style="font-size:1.5rem">{{$player_2->name}}</span><img class="h-10 w-10 rounded-full ml-2" style="object-fit: cover;" src="{{ $player_2->profile_photo_url }}" alt="{{ $player_2->name }}" />
            </div>
        </div>
        @livewire('component.online-list',['showOnline'=>false])
        @section('css')
            <style>
                .footer {
                position: fixed;
                left: 0;
                bottom: 0;
                width: 100%;
                background: rgb(224,167,0);
                background: linear-gradient(90deg, rgba(224,167,0,1) 0%, rgba(232,103,1,1) 100%);
                }
            </style>
        @endsection
</div>
