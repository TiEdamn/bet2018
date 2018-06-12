@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $team->name }}</div>

                    <div class="panel-body">
                        <form action="/team/{{ $team->id }}" method="POST" class="form-inline">
                            {{ method_field('PUT') }}
                            {{ csrf_field() }}
                            <input type="text" name="name" value="{{ $team->name }}" class="form-control">
                            <button type="submit" class="btn btn-success">Изменить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
