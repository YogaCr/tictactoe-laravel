<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    use HasFactory;

    protected $table='match';
    protected $fillable=[
        'user_id_1',
        'user_id_2',
        'user_1_icon',
        'user_2_icon',
        'rematch_request_from',
        'status',
        'winner',
        'box_1',
        'box_2',
        'box_3',
        'box_4',
        'box_5',
        'box_6',
        'box_7',
        'box_8',
        'box_9',
        'turn',
        'user_1_win_count',
        'user_2_win_count'
    ];

    public function FirstPlayer(){
        return $this->belongsTo(User::class,'user_id_1','id');
    }

    public function SecondPlayer(){
        return $this->belongsTo(User::class,'user_id_2','id');
    }

    public function Winner(){
        return $this->belongsTo(User::class,'winner','id');
    }

    public function RematchFrom(){
        return $this->belongsTo(User::class,'rematch_request_from','id');
    }
}
