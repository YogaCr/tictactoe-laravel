<?php

namespace App\Http\Livewire\Page;

use App\Events\GameplayEvent;
use App\Events\RequestReponse;
use App\Models\Match;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;

class GamePage extends Component
{
    public $board = [];
    public $player_1;
    public $player_2;
    public $match_id;
    public $turn_now;
    public $is_playing;
    public $is_draw;
    public $winner;
    public $rematch_request;
    public $match;
    public $player_list;
    public $is_leaving;
    public $leave_name;
    // protected $listeners=["echo:match,GameplayEvent"=>'getMatch','clickField'];

    public function mount($id)
    {
        $this->is_leaving = false;
        $this->player_list = [];
        $decrypted = Crypt::decryptString($id);
        $this->match_id = $decrypted;
        $match = Match::find($decrypted);
        if ($match) {
            if (($match->user_id_1 == Auth::user()->id || $match->user_id_2 == Auth::user()->id)) {
                $this->player_1 = $match->FirstPlayer;
                $this->player_2 = $match->SecondPlayer;
                if ($match->status == 'playing') {
                    $this->board = [
                        [$match->box_1, $match->box_2, $match->box_3],
                        [$match->box_4, $match->box_5, $match->box_6],
                        [$match->box_7, $match->box_8, $match->box_9]
                    ];

                    $this->turn_now = $match->turn;
                    $this->is_playing = true;
                    $this->is_draw = false;
                    $this->rematch_request = false;
                    $this->match = $match;
                    return;
                } elseif ($match->status == 'finish') {
                    $this->board = [
                        [$match->box_1, $match->box_2, $match->box_3],
                        [$match->box_4, $match->box_5, $match->box_6],
                        [$match->box_7, $match->box_8, $match->box_9]
                    ];
                    $this->player_1 = $match->FirstPlayer;
                    $this->player_2 = $match->SecondPlayer;
                    if ($match->winner != null) {
                        $this->winner = $match->Winner;
                        $this->is_draw = false;
                    } else {
                        $this->is_draw = true;
                    }
                    $this->is_playing = false;
                    $this->rematch_request = false;
                    $this->match = $match;
                    return;
                } elseif ($match->status == 'rematch_request') {
                    $this->board = [
                        [$match->box_1, $match->box_2, $match->box_3],
                        [$match->box_4, $match->box_5, $match->box_6],
                        [$match->box_7, $match->box_8, $match->box_9]
                    ];
                    if ($match->winner) {
                        $this->winner = $match->Winner;
                    }
                    if ($match->winner != null) {
                        $this->winner = $match->Winner;
                        $this->is_draw = false;
                    } else {
                        $this->is_draw = true;
                    }
                    $this->is_playing = false;
                    $this->rematch_request = true;
                    $this->match = $match;
                    return;
                }
            }else{
                return redirect('/');
            }
        }else{
            return redirect('/');
        }
    }

    public function render()
    {
        return view('livewire.page.game-page');
    }

    public function getListeners()
    {
        return [
            "echo:match." . $this->match_id . ",GameplayEvent" => 'getMatch',
            'clickField',
            'mainLagi',
            "echo-presence:match-room." . $this->match_id . ",here" => 'here',
            "echo-presence:match-room." . $this->match_id . ",joining" => 'joining',
            "echo-presence:match-room." . $this->match_id . ",leaving" => 'leaving',
        ];
    }

    public function here($data)
    {
        $this->player_list = $data;
    }

    public function joining($data)
    {
        array_push($this->player_list, $data);
        $this->player_list = array_map("unserialize", array_unique(array_map("serialize", $this->player_list)));
    }

    public function leaving($data)
    {
        if (isset($data['id'])) {
            $i = 0;
            for ($i; $i < sizeof($this->player_list); $i++) {
                if ($this->player_list[$i]['id'] == $data['id']) {
                    break;
                }
            }
            array_splice($this->player_list, $i, 1);
            $this->is_leaving = true;
            $this->is_playing = false;
            $match = Match::find($this->match_id);
            $match->status = 'finish';
            $match->save();
            $this->leave_name = $data['name'];
            event(new RequestReponse($match->user_id_1 == Auth::user()->id ? $match->user_id_2 : $match->user_id_1));
        }
    }

    public function getMatch()
    {
        $match = Match::find($this->match_id);
        if ($match) {
            if (($match->user_id_1 == Auth::user()->id || $match->user_id_2 == Auth::user()->id)) {
                if ($match->status == 'playing') {
                    $this->board = [
                        [$match->box_1, $match->box_2, $match->box_3],
                        [$match->box_4, $match->box_5, $match->box_6],
                        [$match->box_7, $match->box_8, $match->box_9]
                    ];
                    $this->turn_now = $match->turn;
                    $this->is_playing = true;
                    return;
                } elseif ($match->status == 'finish') {
                    $this->board = [
                        [$match->box_1, $match->box_2, $match->box_3],
                        [$match->box_4, $match->box_5, $match->box_6],
                        [$match->box_7, $match->box_8, $match->box_9]
                    ];
                    if ($match->winner != null) {
                        $this->winner = $match->Winner;
                        $this->is_draw = false;
                    } else {
                        $this->is_draw = true;
                    }

                    $this->is_playing = false;
                } elseif ($match->status == 'rematch_request') {
                    $this->board = [
                        [$match->box_1, $match->box_2, $match->box_3],
                        [$match->box_4, $match->box_5, $match->box_6],
                        [$match->box_7, $match->box_8, $match->box_9]
                    ];
                    if ($match->winner) {
                        $this->winner = $match->Winner;
                    }
                    if ($match->winner != null) {
                        $this->winner = $match->Winner;
                        $this->is_draw = false;
                    } else {
                        $this->is_draw = true;
                    }
                    $this->is_playing = false;
                    $this->rematch_request = true;
                    $this->match = $match;
                    return;
                }
            }
            else{
                return redirect('/');
            }
        }else{
            return redirect('/');
        }
    }

    public function clickField($no_field)
    {
        $match  = Match::find($this->match_id);
        if ($match) {
            if ($match->user_id_1 == Auth::user()->id || $match->user_id_2 == Auth::user()->id) {
                $arr_match = $match->toArray();
                if ($arr_match['box_' . $no_field] != '#') {
                    return;
                }
                $user_type = -1;
                if ($match->user_id_1 == Auth::user()->id) {
                    $user_type = 1;
                } elseif ($match->user_id_2 == Auth::user()->id) {
                    $user_type = 2;
                } else {
                    return;
                }
                if ($match->turn != $user_type) {
                    return;
                }
                $icon = $user_type == 1 ? $match->user_1_icon : $match->user_2_icon;
                $match->update([
                    'box_' . $no_field => $icon,
                    'turn' => $user_type == 1 ? 2 : 1
                ]);
                if (
                    (($match->box_1 == $match->box_2) && ($match->box_1 == $match->box_3)) || (($match->box_1 == $match->box_4) && ($match->box_1 == $match->box_7))
                ) {
                    if ($match->box_1 != '#') {
                        $icon = $match->box_1;
                        $winner_id = $match->user_1_icon == $icon ? $match->user_id_1 : $match->user_id_2;
                        $this->winner = $match->user_1_icon == $icon ? $match->FirstPlayer : $match->SecondPlayer;
                        $match->update([
                            'status' => 'finish',
                            'winner' => $winner_id
                        ]);
                        if ($winner_id == $match->user_id_1) {
                            $winner = User::find($match->user_id_1);
                            $winner->win = $winner->win + 1;
                            $winner->save();

                            $loser = User::find($match->user_id_2);
                            $loser->lose = $loser->lose + 1;
                            $loser->save();
                        } else {
                            $winner = User::find($match->user_id_2);
                            $winner->win = $winner->win + 1;
                            $winner->save();

                            $loser = User::find($match->user_id_1);
                            $loser->lose = $loser->lose + 1;
                            $loser->save();
                        }
                    }
                }
                if (
                    (($match->box_9 == $match->box_6) && ($match->box_9 == $match->box_3)) || (($match->box_9 == $match->box_8) && ($match->box_9 == $match->box_7))
                ) {

                    if ($match->box_9 != '#') {
                        $icon = $match->box_9;
                        $winner_id = $match->user_1_icon == $icon ? $match->user_id_1 : $match->user_id_2;
                        $this->winner = $match->user_1_icon == $icon ? $match->FirstPlayer : $match->SecondPlayer;
                        $match->update([
                            'status' => 'finish',
                            'winner' => $winner_id
                        ]);
                        if ($winner_id == $match->user_id_1) {
                            $winner = User::find($match->user_id_1);
                            $winner->win = $winner->win + 1;
                            $winner->save();

                            $loser = User::find($match->user_id_2);
                            $loser->lose = $loser->lose + 1;
                            $loser->save();
                        } else {
                            $winner = User::find($match->user_id_2);
                            $winner->win = $winner->win + 1;
                            $winner->save();

                            $loser = User::find($match->user_id_1);
                            $loser->lose = $loser->lose + 1;
                            $loser->save();
                        }
                    }
                }
                if (
                    (($match->box_5 == $match->box_1) && ($match->box_5 == $match->box_9)) || (($match->box_5 == $match->box_3) && ($match->box_5 == $match->box_7)) ||
                    (($match->box_5 == $match->box_2) && ($match->box_5 == $match->box_8)) || (($match->box_4 == $match->box_5) && ($match->box_5 == $match->box_6))
                ) {
                    if ($match->box_5 != '#') {
                        $icon = $match->box_5;
                        $winner_id = $match->user_1_icon == $icon ? $match->user_id_1 : $match->user_id_2;
                        $this->winner = $match->user_1_icon == $icon ? $match->FirstPlayer : $match->SecondPlayer;
                        $match->update([
                            'status' => 'finish',
                            'winner' => $winner_id
                        ]);
                        if ($winner_id == $match->user_id_1) {
                            $winner = User::find($match->user_id_1);
                            $winner->win = $winner->win + 1;
                            $winner->save();

                            $loser = User::find($match->user_id_2);
                            $loser->lose = $loser->lose + 1;
                            $loser->save();
                        } else {
                            $winner = User::find($match->user_id_2);
                            $winner->win = $winner->win + 1;
                            $winner->save();

                            $loser = User::find($match->user_id_1);
                            $loser->lose = $loser->lose + 1;
                            $loser->save();
                        }
                    }
                }
                if ($match->box_1 != '#' && $match->box_2 != '#' && $match->box_3 != '#' && $match->box_4 != '#' && $match->box_5 != '#' && $match->box_6 != '#' && $match->box_7 != '#' && $match->box_8 != '#' && $match->box_9 != '#') {
                    $match->update([
                        'status' => 'finish'
                    ]);

                    $user_1 = User::find($match->user_id_1);
                    $user_1->draw = $user_1->draw + 1;
                    $user_1->save();

                    $user_2 = User::find($match->user_id_2);
                    $user_2->draw = $user_2->draw + 1;
                    $user_2->save();
                }
                event(new GameplayEvent($match));
            }else{
                return redirect('/');
            }
        }else{
            return redirect('/');
        }
        
    }

    public function mainLagi()
    {
        $match = Match::find($this->match_id);
        if ($match->status == 'rematch_request' && $match->rematch_request_from != Auth::user()->id) {
            $user_id_1 = $match->user_id_1;
            $user_id_2 = $match->user_id_2;
            $user_1_icon = random_int(0, 10) < 5 ? 'X' : 'O';
            $match->update([
                'box_1' => '#',
                'box_2' => '#',
                'box_3' => '#',
                'box_4' => '#',
                'box_5' => '#',
                'box_6' => '#',
                'box_7' => '#',
                'box_8' => '#',
                'box_9' => '#',
                'winner' => null,
                'status' => 'playing',
                'user_1_icon' => $user_1_icon,
                'user_2_icon' => ($user_1_icon == 'X' ? 'O' : 'X'),
                'turn' => random_int(0, 10) < 5 ? 1 : 2,
                'rematch_request_from' => null
            ]);
            $this->rematch_request = false;
        } else {
            $match->status = 'rematch_request';
            $match->rematch_request_from = Auth::user()->id;
            $match->save();
            $this->rematch_request = true;
        }

        event(new GameplayEvent($match));
    }
}
