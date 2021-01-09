<?php

namespace App\Http\Livewire\Component;

use App\Events\RequestReponse;
use App\Models\Match;
use Livewire\Component;
use App\Models\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class TableRequestList extends Component
{
    //Boolean untuk modal request diajak bermain
    public $showModalRequest;
    //Nama User yang mengajak bermain
    public $name_from;
    //ID Request
    public $request_id;

    public $req_list;

    public function mount()
    {
        // $req = Request::where('to', Auth::user()->id)->where('status','pending')->first();
        // if ($req) {
        //     $this->showModalRequest = true;
        //     $this->name_from = $req->From->name;
        //     $this->request_id = $req->id;
        // } else {
        //     $this->showModalRequest = false;
        // }
        $this->req_list = [];
        $req = Request::where('to', Auth::user()->id)->where('status','pending')->get();
        if ($req) {
            $this->req_list = $req;
        }
        
    }


    public function render()
    {
        return view('livewire.component.table-request-list');
    }

    public function getListeners()
    {
        return ['echo:request-to-play.'.Auth::user()->id.',RequestToPlay'=>'getRequestToPlay','acceptRequest','rejectRequest'];
    }
    
    public function getRequestToPlay()
    {
        // $req = Request::where('to', Auth::user()->id)->where('status','pending')->first();
        // if ($req) {
        //     $this->showModalRequest = true;
        //     $this->name_from = $req->From->name;
        //     $this->request_id = $req->id;
        // }
        $req = Request::where('to', Auth::user()->id)->where('status','pending')->get();
        if ($req) {
            $this->req_list = $req;
        }
    }

    public function acceptRequest($req_id)
    {
        $req = Request::find($req_id);
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
        event(new RequestReponse($req->from));
        return redirect()->to('/game/'.Crypt::encryptString($match->id));
    }

    public function rejectRequest($req_id)
    {
        $this->showModalRequest = false;
        $req = Request::find($req_id);
        $req->status='rejected';
        $req->save();
        // broadcast(new RequestReponse($req))->toOthers();
    }
}
