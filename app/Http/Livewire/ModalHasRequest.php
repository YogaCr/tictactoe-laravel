<?php

namespace App\Http\Livewire;

use App\Events\RequestReponse;
use App\Models\Match;
use Livewire\Component;
use App\Models\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class ModalHasRequest extends Component
{
    //Boolean untuk modal request diajak bermain
    public $showModalRequest;
    //Nama User yang mengajak bermain
    public $name_from;
    //ID Request
    public $request_id;
    protected $listeners = [
        'echo:request-to-play,RequestToPlay'=>'getRequestToPlay'
    ];

    public function mount()
    {
        $req = Request::where('to', Auth::user()->id)->where('status','pending')->first();
        if ($req) {
            $this->showModalRequest = true;
            $this->name_from = $req->From->name;
            $this->request_id = $req->id;
        } else {
            $this->showModalRequest = false;
        }
    }

    public function render()
    {
        return view('livewire.modal-has-request');
    }

    public function getRequestToPlay()
    {
        $req = Request::where('to', Auth::user()->id)->where('status','pending')->first();
        if ($req) {
            $this->showModalRequest = true;
            $this->name_from = $req->From->name;
            $this->request_id = $req->id;
        }
    }

    public function acceptRequest()
    {
        $req = Request::find($this->request_id);
        $user_1_icon = random_int(0,10)<5?'X':'O';
        $match = Match::create([
            'user_id_1'=>$req->from,
            'user_id_2'=>$req->to,
            'user_1_icon'=>$user_1_icon,
            'user_2_icon'=>$user_1_icon=='X'?'O':'X',
            'status'=>'playing',
            'turn'=>random_int(0,10)<5?1:2
        ]);
        $this->showModalRequest = false;
        $req->status='accepted';
        $req->save();
        broadcast(new RequestReponse($req,$match))->toOthers();
        return redirect()->to('/game/'.Crypt::encryptString($match->id));
    }

    public function rejectRequest()
    {
        $this->showModalRequest = false;
        $req = Request::find($this->request_id);
        $req->status='rejected';
        $req->save();
        broadcast(new RequestReponse($req))->toOthers();
    }
}
