<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Helper\UserHelper;
use App\Match;
use App\Team;
use Illuminate\Http\Request;

use App\Http\Requests;

class MatchController extends BaseController
{

    public function __construct()
    {
        $this->middleware('auth');

        if(!UserHelper::isAdmin())
            return abort(404);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $matches = Match::orderBy('played_at', 'desc')->get();

        $teams = Team::orderBy('name')->get();

        return view('match.index', ['match' => $matches, 'teams' => $teams]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Match::create([
            'home_id' => $request->home_id,
            'visitor_id' => $request->visitor_id,
            'played_at' => $request->played_at
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $match = Match::find($id);

        $teams = Team::orderBy('name')->get();

        return view('match.show', ['match' => $match, 'teams' => $teams]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $match = Match::find($id);

        $match->update([
            'home_id' => $request->home_id,
            'visitor_id' => $request->visitor_id,
            'played_at' => $request->played_at,
            'visitor_score' => $request->visitor_score ? $request->visitor_score : null,
            'home_score' => $request->home_score ? $request->home_score : null
        ]);

        return redirect('/match');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
