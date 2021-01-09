<?php

namespace App\Http\Livewire\Page;

use App\Models\Match;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProfilePage extends Component
{
    public $jumlah_main;
    public $menang;
    public $seri;
    public $kalah;

    public function mount(){
        $this->jumlah_main = Match::where('user_id_1',Auth::user()->id)->orWhere('user_id_2',Auth::user()->id)->count();
        $this->menang = Match::whereRaw('(`user_id_1`='.Auth::user()->id.' or `user_id_2`='.Auth::user()->id.') AND `winner`='.Auth::user()->id." AND `status`='finish'")->count();
        $this->kalah = Match::whereRaw('(`user_id_1`='.Auth::user()->id.' or `user_id_2`='.Auth::user()->id.') AND `winner` <> '.Auth::user()->id." AND `winner` IS NOT NULL AND `status`='finish'")->count();
        $this->seri = Match::whereRaw("(`user_id_1`=".Auth::user()->id." or `user_id_2`=".Auth::user()->id.") AND `winner` IS NULL AND `status`='finish'")->count();
    }
    public function render()
    {
        return view('livewire.page.profile-page');
    }
}
