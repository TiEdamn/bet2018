@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Матчи</div>

                    <div class="panel-body">

                        <form action="/match" method="POST" class="form-inline" style="margin-bottom: 20px;">
                            {{ csrf_field() }}
                            <select name="home_id" id="home_id" class="form-control">
                                @foreach($teams as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            <select name="visitor_id" id="visitor_id" class="form-control">
                                @foreach($teams as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            <input type="text" name="played_at" placeholder="дата матча" class="form_datetime form-control">
                            <button type="submit" class="btn btn-success">Добавить</button>
                        </form>

                        @if(count($match) > 0)
                            <table class="table table-striped table-bordered">
                                <tr>
                                    <th>Матч</th>
                                    <th>Дата</th>
                                    <th>Счет</th>
                                </tr>
                                @foreach($match as $item)
                                    <tr>
                                        <td><a href="/match/{{$item->id}}">{{ $item->home->name }} - {{ $item->visitor->name }}</a></td>
                                        <td>{{ date('Y-m-d H:i', strtotime($item->played_at)) }}</td>
                                        <td>{{ $item->home_score }} - {{ $item->visitor_score }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        @else
                            <h2>Матчей нет!</h2>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
