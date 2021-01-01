<?php

namespace App\Http\Livewire;

use App\Events\GameplayEvent;
use App\Models\Match;
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
    // protected $listeners=["echo:match,GameplayEvent"=>'getMatch','clickField'];

    public function mount($id)
    {
        $decrypted = Crypt::decryptString($id);
        $this->match_id = $decrypted;
        $match = Match::find($decrypted);
        if ($match) {
            if (($match->user_id_1 == Auth::user()->id || $match->user_id_2 == Auth::user()->id)) {
                if ($match->status == 'playing') {
                    $this->board = [
                        [$match->box_1, $match->box_2, $match->box_3],
                        [$match->box_4, $match->box_5, $match->box_6],
                        [$match->box_7, $match->box_8, $match->box_9]
                    ];
                    $this->player_1 = $match->FirstPlayer->name;
                    $this->player_2 = $match->SecondPlayer->name;
                    $this->turn_now = $match->turn;
                    $this->is_playing = true;
                    $this->is_draw = false;
                    return;
                } elseif ($match->status == 'finish') {
                    $this->board = [
                        [$match->box_1, $match->box_2, $match->box_3],
                        [$match->box_4, $match->box_5, $match->box_6],
                        [$match->box_7, $match->box_8, $match->box_9]
                    ];
                    $this->player_1 = $match->FirstPlayer->name;
                    $this->player_2 = $match->SecondPlayer->name;
                    if ($match->winner) {
                        $this->winner = $match->Winner->name;
                    } else {
                        $this->is_draw = true;
                    }
                    $this->is_playing = false;
                    return;
                }
            }
        }
        return redirect('/');
    }

    public function render()
    {
        return view('livewire.game-page');
    }

    public function getListeners()
    {
        return ["echo:match." . $this->match_id . ",GameplayEvent" => 'getMatch', 'clickField'];
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
                    if ($match->winner) {
                        $this->winner = $match->Winner->name;
                    } else {
                        $this->is_draw = true;
                    }

                    $this->is_playing = false;
                }
            }
        }
    }

    public function clickField($no_field)
    {
        $match  = Match::find($this->match_id);
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
                $this->winner = $match->user_1_icon == $icon ? $match->FirstPlayer->name : $match->SecondPlayer->name;
                $match->update([
                    'status' => 'finish',
                    'winner' => $winner_id
                ]);
            }
        } elseif (
            (($match->box_9 == $match->box_6) && ($match->box_9 == $match->box_3)) || (($match->box_9 == $match->box_8) && ($match->box_9 == $match->box_7))
        ) {
            if ($match->box_9 != '#') {
                $icon = $match->box_9;
                $winner_id = $match->user_1_icon == $icon ? $match->user_id_1 : $match->user_id_2;
                $this->winner = $match->user_1_icon == $icon ? $match->FirstPlayer->name : $match->SecondPlayer->name;
                $match->update([
                    'status' => 'finish',
                    'winner' => $winner_id
                ]);
            }
        } elseif (
            (($match->box_5 == $match->box_1) && ($match->box_5 == $match->box_9)) || (($match->box_5 == $match->box_3) && ($match->box_5 == $match->box_7)) ||
            (($match->box_5 == $match->box_2) && ($match->box_5 == $match->box_8)) || (($match->box_4 == $match->box_5) && ($match->box_5 == $match->box_6))
        ) {
            if ($match->box_5 != '#') {
                $icon = $match->box_5;
                $winner_id = $match->user_1_icon == $icon ? $match->user_id_1 : $match->user_id_2;
                $this->winner = $match->user_1_icon == $icon ? $match->FirstPlayer->name : $match->SecondPlayer->name;
                $match->update([
                    'status' => 'finish',
                    'winner' => $winner_id
                ]);
            }
        }
        if ($match->box_1 != '#' && $match->box_2 != '#' && $match->box_3 != '#' && $match->box_4 != '#' && $match->box_5 != '#' && $match->box_6 != '#' && $match->box_7 != '#' && $match->box_8 != '#' && $match->box_9 != '#') {
            $match->update([
                'status' => 'finish'
            ]);
        }
        event(new GameplayEvent($match));
    }
}
