<?php

namespace App\Http\Livewire\Component;

use Livewire\Component;
use App\Models\Request;
use Illuminate\Support\Facades\Auth;

class ModalPendingRequest extends Component
{
    //Boolean untuk modal request diajak bermain
    public $showModalPendingRequest;
    //Nama User yang mengajak bermain
    public $name_to;
    public $req_id;
    public function mount(){
        $req = Request::where('from',Auth::user()->id)->where('status','pending')->first();
        if($req){
            $this->showModalPendingRequest = true;
            $this->name_to = $req->To->name;
            $this->req_id = $req->id;
        }else{
            $this->showModalPendingRequest = false;
        }
    }

    public function render()
    {
        return view('livewire.component.modal-pending-request');
    }

    public function getListeners(){
        $req_id = $this->req_id;
        return ['hasPendingRequest','echo:response-req.'.$req_id.',App\Event\RequestResponse'=>'getRequestResponse'];
    }

    public function hasPendingRequest(){
        $req = Request::where('from',Auth::user()->id)->where('status','pending')->first();
        if($req){
            $this->showModalPendingRequest = true;
            $this->name_to = $req->To->name;
            $this->req_id = $req->id;
        }else{
            $this->showModalPendingRequest = false;
        }
    }

    public function getRequestResponse($response){
        dd('tes');
        $this->showModalPendingRequest = false;
        $req = Request::find($response['req']['id']);
        if($req->status=='accepted'){
            return redirect('/game/'.$response['match']['id']);
        }else{

        }
    }
}
