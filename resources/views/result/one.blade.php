@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $match->home->name }} - {{ $match->visitor->name }} {{ date('Y-m-d H:i', strtotime($match->played_at)) }}</div>

                    <div class="panel-body">
                        <ol>
                            @foreach($match->bets as $item)
                                @if($item->home == $match->home_score && $item->visitor == $match->visitor_score)
                                    <li class="green">{{ $item->user->name }} - {{ $item->home }}:{{$item->visitor}}</li>
                                @elseif($item->home == $item->visitor && $match->home_score == $match->visitor_score)
                                    <li class="yellow">{{ $item->user->name }} - {{ $item->home }}:{{$item->visitor}}</li>
                                @else
                                    <li class="red">{{ $item->user->name }} - {{ $item->home }}:{{$item->visitor}}</li>
                                @endif
                            @endforeach
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
