<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    protected $table = 'matchs';

    protected $fillable = ['home_id', 'visitor_id', 'home_score', 'visitor_score', 'played_at'];

    public function home(){
        return $this->belongsTo(Team::class, 'home_id');
    }

    public function visitor(){
        return $this->belongsTo(Team::class, 'visitor_id');
    }

    public function bets() {
        return $this->hasMany(Bet::class, 'match_id', 'id');
    }
}
