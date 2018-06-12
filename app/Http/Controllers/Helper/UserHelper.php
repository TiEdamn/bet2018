<?php

namespace App\Http\Controllers\Helper;

use App\Bet;
use Illuminate\Support\Facades\Auth;

class UserHelper
{
    public static function isAdmin()
    {
        return in_array(Auth::user()->email, ['ainane2@mail.ru']);
    }

    public static function matchData($id)
    {
        $match = Bet::where('match_id', '=', $id)
            ->where('user_id', '=', Auth::user()->id)
            ->first();

        if($match)
            return ['home' => $match->home, 'visitor' => $match->visitor];
        else
            return ['home' => null, 'visitor' => null];
    }
}