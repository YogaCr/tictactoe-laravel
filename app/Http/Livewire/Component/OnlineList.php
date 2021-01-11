<?php

namespace App\Http\Livewire\Component;

use App\Events\RequestToPlay;
use App\Events\UserOnline;
use App\Models\Match;
use App\Models\User;
use App\Models\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class OnlineList extends Component
{
    protected $listeners = [
        'echo-presence:demo,here' => 'here',
        'echo-presence:demo,joining' => 'joining',
        'echo-presence:demo,leaving' => 'leaving'
    ];

    //Daftar user online
    public $user_online = [];
    //ID User yang ingin diajak bermain
    public $user_id_target;
    //Nama User yang ingin diajak bermain
    public $name_target;
    //Boolean untuk modal mengajak bermain
    public $showModalPlayer;

    public $showOnline;

    public $isExpanded;

    public $showAlert;
    public $alertType;
    public $alertMessage;
    public function mount($showOnline)
    {
        $this->showAlert = false;
        $this->showOnline = $showOnline;
        $this->isExpanded = false;
        $this->showModalPlayer = false;
        $req = Request::where('to', Auth::user()->id)->first();
        if ($req) {
            $this->showModalRequest = true;
            $this->name_from = $req->From->name;
        } else {
            $this->showModalRequest = false;
        }
    }

    public function render()
    {
        return view('livewire.component.online-list');
    }

    public function here($data)
    {
        $this->user_online = $data;
        // $user = User::find(Auth::user()->id);
        // $user->status = 'online';
        // $user->save();
        // $this->user_online = User::orderBy('name','asc')->where('status', 'online')->select(['id','name'])->get();
        // $this->user_online = $this->user_online->toArray();
    }

    public function joining($data)
    {
        // dd($data);
        array_push($this->user_online, $data);
        usort($this->user_online, function ($item1, $item2) {
            if (isset($item1['name']) && isset($item2['name'])) {
                return $item1['name'] <=> $item2['name'];
            }
        });
        $this->user_online = array_map("unserialize", array_unique(array_map("serialize", $this->user_online)));
    }

    public function leaving($data)
    {
        // dd($data);
        // dd($this->user_online);
        if (isset($data['id'])) {
            // $user = User::find($data['id']);
            // $user->status = 'offline';
            // $user->save();
            $i = 0;
            for ($i; $i < sizeof($this->user_online); $i++) {
                if ($this->user_online[$i]['id'] == $data['id']) {
                    break;
                }
            }
            array_splice($this->user_online, $i, 1);
        }
    }

    public function ajakOrang($id, $name)
    {
        if ($id == Auth::user()->id) {
            return;
        }
        $this->name_target = $name;
        $this->user_id_target = $id;
        $this->showModalPlayer = true;
    }

    public function dismissModalPlayer()
    {
        $this->showModalPlayer = false;
    }

    public function sendRequest()
    {
        $this->showModalPlayer = false;
        $req_check = Request::whereRaw("((`from`='" . Auth::user()->id . "' and `to`='" . $this->user_id_target . "') or (`from`='" . $this->user_id_target . "' and `to`='" . Auth::user()->id . "')) and `status`='pending'")->count();
        if ($req_check > 0) {
            $this->showAlert = true;
            $this->alertType = 'danger';
            $this->alertMessage = 'Anda sudah mengirim permintaan kepada pemain ini sebelumnya. Harap tunggu respon.';
            return;
        }
        $match_check = Match::whereRaw("((`user_id_1`='" . Auth::user()->id . "' and `user_id_2`='" . $this->user_id_target . "') or (`user_id_1`='" . $this->user_id_target . "' and `user_id_2`='" . Auth::user()->id . "')) and `status`='playing'")->count();
        if ($match_check > 0) {
            $this->showAlert = true;
            $this->alertType = 'danger';
            $this->alertMessage = 'Anda masih memiliki permainan yang belum selesai dengan pemain ini.';
            return;
        }

        Request::create([
            'from' => Auth::user()->id,
            'to' => $this->user_id_target
        ]);
        broadcast(new RequestToPlay(User::find($this->user_id_target)))->toOthers();
        $this->emit('hasPendingRequest');
        $this->showAlert = true;
        $this->alertType = 'success';
        $this->alertMessage = 'Permintaan berhasil dikirim';
    }

    public function dismissAlert()
    {
        $this->showAlert = false;
        $this->alertType = '';
        $this->alertMessage = '';
    }

    public function setOnlineExpanded()
    {
        $this->isExpanded = !$this->isExpanded;
    }
}
