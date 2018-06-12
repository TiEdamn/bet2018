@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $match->home->name }} - {{ $match->visitor->name }}</div>

                    <div class="panel-body">
                        <form action="match/{{ $match->id }}" method="POST" class="form-inline">
                            {{ method_field('PUT') }}
                            {{ csrf_field() }}<select name="home_id" id="home_id" class="form-control">
                                @foreach($teams as $item)
                                    <option value="{{ $item->id }}" {{ $item->id == $match->home_id ? 'selected' : '' }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                            <select name="visitor_id" id="visitor_id" class="form-control">
                                @foreach($teams as $item)
                                    <option value="{{ $item->id }}" {{ $item->id == $match->visitor_id ? 'selected' : '' }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                            <input type="text" name="home_score" value="{{ $match->home_score ? $match->home_score : '' }}" placeholder="{{ $match->home->name }}" class="form-control">
                            <input type="text" name="visitor_score" value="{{ $match->visitor_score ? $match->visitor_score : '' }}" placeholder="{{ $match->visitor->name }}" class="form-control">
                            <input type="text" name="played_at" value="{{ date('Y-m-d H:i', strtotime($match->played_at)) }}" placeholder="дата матча" class="form_datetime form-control">
                            <button type="submit" class="btn btn-success">Изменить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
