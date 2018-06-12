<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bet extends Model
{
    protected $table = 'bets';

    protected $fillable = ['home', 'visitor', 'match_id', 'user_id'];

    public function match(){
        return $this->belongsTo(Match::class, 'match_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
