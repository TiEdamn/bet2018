@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Команды</div>

                    <div class="panel-body">
                        <form action="/team" method="POST" class="form-inline" style="margin-bottom: 20px;">
                            {{ csrf_field() }}
                            <input type="text" name="name" class="form-control">
                            <button type="submit" class="btn btn-success">Добавить</button>
                        </form>
                        @if(count($teams) > 0)
                            <table class="table table-striped table-bordered">
                                <tr>
                                    <th>#</th>
                                    <th>Страна</th>
                                </tr>
                                @foreach($teams as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td><a href="/team/{{$item->id}}">{{ $item->name }}</a></td>
                                    </tr>
                                @endforeach
                            </table>
                        @else
                            <h2>Команд нет!</h2>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
