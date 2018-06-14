<?php

namespace App\Http\Controllers;

use App\Bet;
use App\Http\Requests;
use App\Match;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

class HomeController extends BaseController
{

    public function rules($request, $id = null)
    {
        return [
            'home' => 'required|integer|max:50|min:0',
            'visitor' => 'required|integer|max:50|min:0',
        ];
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $matches = Match::where('played_at', '>', date('Y-m-d H:i:s'))
            ->whereBetween('played_at', [date('Y-m-d 00:00:00'), date("Y-m-d 00:00:00", mktime(0, 0, 0, date("m") , date("d")+1,date("Y")))])
            ->orderBy('played_at', 'asc')
            ->get();

        return view('home', ['matches' => $matches]);
    }

    public function bet($id, Request $request) {

        $this->validator($request, $this->rules($request));

        $match = Match::find($id);

        if($match->played_at < date('Y-m-d H:i:s'))
            abort(404);

        $bet = Bet::firstOrCreate([
            'match_id' => $id,
            'user_id' => Auth::user()->id
        ]);

        $bet->update([
            'home' => $request->home,
            'visitor' => $request->visitor
        ]);

        $this->ajax['status'] = true;
        $this->ajax['data'] = $bet;

        return $this->ajax;
    }

    public function result() {
        $users = User::all();
        $matches = Match::where('played_at', '<', date('Y-m-d H:i:s'))
            ->get();

        return view('result.all', ['matches' => $matches, 'users' => $users]);
    }

    public function leader() {

        $users = User::orderBy('score', 'desc')->get();

        return view('leader.index', ['users' => $users]);

    }

    public function recount() {

        # Отправка таски
        Artisan::queue('recount:score');

        $path = $_SERVER['DOCUMENT_ROOT'].'/../app/bet/';
        //exec('php '.$path.'artisan recount:score --queue > /dev/null &');

        $this->ajax['status'] = true;
        $this->ajax['data'] = $path;

        return $this->ajax;
    }
}
