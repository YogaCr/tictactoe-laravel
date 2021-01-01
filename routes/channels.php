<?php

use App\Models\Match;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('demo',function($user){
    return [
        'id' => $user->id,
        'name' => $user->name
    ];
});

Broadcast::channel('response-req.{reqId}',function($user,$reqId){
    $req = \App\Models\Request::find($reqId);
    return ($user->id==$req->from||$user->id==$req->to);
});

Broadcast::channel('match.{$matchId}',function($user,$matchId){
    $match = Match::find($matchId);
    return ($user->id==$match->user_id_1||$user->id==$match->user_id_2);
});
