@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Доска почета</div>

                    <div class="panel-body">

                        @if(UserHelper::isAdmin())
                            <div class="text-center" style="margin-bottom: 20px">
                                <button class="btn btn-success btn-recount btn-lg">Пересчитать</button>
                            </div>
                        @endif

                        @if(count($users) > 0)
                            <table class="table table-striped table-bordered">
                                <tr>
                                    <th>#</th>
                                    <th>Пользователь</th>
                                    <th>Очки</th>
                                </tr>
                                @foreach($users as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->score }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        @else
                            <h2>Нет участников!</h2>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
