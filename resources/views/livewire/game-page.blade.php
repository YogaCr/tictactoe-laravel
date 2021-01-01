<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <h1 class="font-semibold text-xl text-gray-800 leading-tight text-center">
        @if($is_playing)
            Giliran {{$turn_now==1?$player_1:$player_2}}
        @else
            @if($is_draw)
                Pertandingan Seri
            @else
                {{$winner}} menang
            @endif
        @endif

    </h1>
    <div class="d-flex justify-content-center">
        <div class="d-inline-flex flex-column">
            {{-- <div class="d-inline-flex">
                <livewire:field :field="1" :matchId="$match_id" :icon="$board[0][0]" :key="'field-1'"/>
                <livewire:field :field="2" :matchId="$match_id" :icon="$board[0][1]" :key="'field-2'"/>
                <livewire:field :field="3" :matchId="$match_id" :icon="$board[0][2]" :key="'field-3'"/>
            </div>
            <div class="d-inline-flex">
                <livewire:field :field="4" :matchId="$match_id" :icon="$board[1][0]" :key="'field-4'"/>
                <livewire:field :field="5" :matchId="$match_id" :icon="$board[1][1]" :key="'field-5'"/>
                <livewire:field :field="6" :matchId="$match_id" :icon="$board[1][2]" :key="'field-6'"/>
            </div>
            <div class="d-inline-flex">
                <livewire:field :field="7" :matchId="$match_id" :icon="$board[2][0]" :key="'field-7'"/>
                <livewire:field :field="8" :matchId="$match_id" :icon="$board[2][1]" :key="'field-8'"/>
                <livewire:field :field="9" :matchId="$match_id" :icon="$board[2][2]" :key="'field-9'"/>
            </div> --}}
            <div class="d-inline-flex">
                <div class="field" style="border:2px solid black" wire:click="$emit('clickField',1)">
                    <button class="content" {{$is_playing?'':'disabled'}}>
                        <h1 style="font-size:10rem"><center>{{$board[0][0]=='#'?' ':$board[0][0]}}</center></h1>
                    </button>
                </div>
                <div class="field" style="border:2px solid black" wire:click="$emit('clickField',2)">
                    <button class="content" {{$is_playing?'':'disabled'}}>
                        <h1 style="font-size:10rem"><center>{{$board[0][1]=='#'?' ':$board[0][1]}}</center></h1>
                    </button>
                </div>
                <div class="field" style="border:2px solid black" wire:click="$emit('clickField',3)">
                    <button class="content" {{$is_playing?'':'disabled'}}>
                        <h1 style="font-size:10rem"><center>{{$board[0][2]=='#'?' ':$board[0][2]}}</center></h1>
                    </button>
                </div>
            </div>
            <div class="d-inline-flex">
                <div class="field" style="border:2px solid black" wire:click="$emit('clickField',4)">
                    <button class="content" {{$is_playing?'':'disabled'}}>
                        <h1 style="font-size:10rem"><center>{{$board[1][0]=='#'?' ':$board[1][0]}}</center></h1>
                    </button>
                </div>
                <div class="field" style="border:2px solid black" wire:click="$emit('clickField',5)">
                    <button class="content" {{$is_playing?'':'disabled'}}>
                        <h1 style="font-size:10rem"><center>{{$board[1][1]=='#'?' ':$board[1][1]}}</center></h1>
                    </button>
                </div>
                <div class="field" style="border:2px solid black" wire:click="$emit('clickField',6)">
                    <button class="content" {{$is_playing?'':'disabled'}}>
                        <h1 style="font-size:10rem"><center>{{$board[1][2]=='#'?' ':$board[1][2]}}</center></h1>
                    </button>
                </div>
            </div>
            <div class="d-inline-flex">
                <div class="field" style="border:2px solid black" wire:click="$emit('clickField',7)">
                    <button class="content" {{$is_playing?'':'disabled'}}>
                        <h1 style="font-size:10rem"><center>{{$board[2][0]=='#'?' ':$board[2][0]}}</center></h1>
                    </button>
                </div>
                <div class="field" style="border:2px solid black" wire:click="$emit('clickField',8)">
                    <button class="content" {{$is_playing?'':'disabled'}}>
                        <h1 style="font-size:10rem"><center>{{$board[2][1]=='#'?' ':$board[2][1]}}</center></h1>
                    </button>
                </div>
                <div class="field" style="border:2px solid black" wire:click="$emit('clickField',9)">
                    <button class="content" {{$is_playing?'':'disabled'}}>
                        <h1 style="font-size:10rem"><center>{{$board[2][2]=='#'?' ':$board[2][2]}}</center></h1>
                    </button>
                </div>
            </div>
        </div>
    </div>
   
</div>
