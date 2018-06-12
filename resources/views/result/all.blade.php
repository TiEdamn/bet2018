@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Прощедщие матчи</div>

                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <tr>
                                    <th>#</th>
                                    @foreach($users as $user)
                                        <th class="text-center {{ $user->id == Auth::user()->id ? 'green' : '' }}">{{ $user->name }}</th>
                                    @endforeach
                                </tr>
                                @if(count($matches) > 0)
                                    @foreach($matches as $match)
                                        <tr>
                                            <td>{{ $match->home->name }} <span class="green score">{{$match->home_score}}</span> - <span class="green score">{{$match->visitor_score}}</span> {{ $match->visitor->name }}<br/><small>{{ date('Y-m-d H:i', strtotime($match->played_at)) }}</small></td>
                                            @foreach($users as $user)
                                                @php
                                                    $current = $user->bets()->where('match_id', '=', $match->id)->first();
                                                @endphp
                                                @if($current)
                                                    @if($match->home_score == $current->home && $match->visitor_score == $current->visitor)
                                                        <td class="green text-center">{{ $current->home }} - {{ $current->visitor }}</td>
                                                    @elseif(($match->home_score == $match->visitor_score && $current->home == $current->visitor) || ($match->home_score > $match->visitor_score && $current->home > $current->visitor) || ($match->home_score < $match->visitor_score && $current->home < $current->visitor))
                                                        <td class="yellow text-center">{{ $current->home }} - {{ $current->visitor }}</td>
                                                    @else
                                                        <td class="red text-center">{{ $current->home }} - {{ $current->visitor }}</td>
                                                    @endif
                                                @else
                                                    <td class="red text-center">-</td>
                                                @endif
                                            @endforeach
                                        </tr>
                                    @endforeach
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
