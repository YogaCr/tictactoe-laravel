<?php

namespace App\Http\Livewire\Component;

use App\Events\GameplayEvent;
use App\Models\Match;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;

class Field extends Component
{
    public $icon;
    public $field_no;
    public $match_id;
    
    public function mount($field,$matchId,$icon){
        $this->field_no = $field;
        $this->match_id = $matchId;
        $this->icon=$icon;
    }

    public function render()
    {
        return view('livewire.component.field');
    }

    public function clickField(){
        $match  = Match::find($this->match_id);
        $user_type=-1;
        if($match->user_id_1==Auth::user()->id){
            $user_type=1;
        }elseif($match->user_id_2==Auth::user()->id){
            $user_type=2;
        }else{
            return;
        }
        if($match->turn!=$user_type){
            return;
        }
        $icon = $user_type==1?$match->user_1_icon:$match->user_2_icon;
        $match->update([
            'box_'.$this->field_no=>$icon,
            'turn'=>$user_type==1?2:1
        ]);
        event(new GameplayEvent($match));        
        
    }
}
