<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Helper\UserHelper;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class TestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        if(!UserHelper::isAdmin())
            return abort(404);
    }

    public function index() {

        $users = User::all();

        foreach ($users as $user) {

            $score = 0;

            foreach ($user->bets as $bet) {
                if($bet->home == $bet->match->home_score && $bet->visitor == $bet->match->visitor_score)
                    $score+=3;
                else if(($bet->home == $bet->visitor && $bet->match->home_score == $bet->match->visitor_score) || ($bet->home > $bet->visitor && $bet->match->home_score > $bet->match->visitor_score) || ($bet->home < $bet->visitor && $bet->match->home_score < $bet->match->visitor_score))
                    $score+=1;
                else
                    $score+=0;
            }

            echo $user->name .' - '.$score;

            echo '<br/>';


        }


    }
}
