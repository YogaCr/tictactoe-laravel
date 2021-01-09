<?php

namespace App\Http\Livewire\Component;

use App\Models\Match;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;

class TableGameList extends Component
{
    // public $showModalHasGame;
    // public $match_id;
    public $match_list;    
    public function mount(){
        $match = Match::whereRaw("(`user_id_1` = '".Auth::user()->id."' or `user_id_2` = '".Auth::user()->id."') and `status` = 'playing'")->get();
        // if($match&&sizeof($match)){
        //     $this->showModalHasGame=true;
        //     $this->match_id = $match[0]->id;
        // }else{
        //     $this->showModalHasGame=false;
        // }
        $this->match_list = $match;
    }
    public function getListeners(){
        return ['echo:response-req.'.Auth::user()->id.',RequestReponse'=>'reloadGameTable','goToGame'];
    }

    public function reloadGameTable(){
        $match = Match::whereRaw("(`user_id_1` = '".Auth::user()->id."' or `user_id_2` = '".Auth::user()->id."') and `status` = 'playing'")->get();
        $this->match_list = $match;
    }

    public function goToGame($match_id){
        return redirect()->to('/game/'.Crypt::encryptString($match_id));
    }

    public function render()
    {
        return view('livewire.component.table-game-list');
    }
}
