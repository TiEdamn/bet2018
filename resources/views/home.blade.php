@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">1X Bet - Большие выигрыши ... и дальше по тексту</div>

                <div class="panel-body">
                    @if(count($matches) > 0 && !Auth::guest())
                        <div class="row">
                            @foreach($matches as $key => $item)
                                <div class="col-md-3">
                                    <form action="bet/{{ $item->id }}" method="POST" class="form-inline ajax-form" style="margin-bottom: 20px">
                                        @php
                                            $data = UserHelper::matchData($item->id);
                                        @endphp
                                        <table class="table table-striped table-bordered">
                                            <tr>
                                                <td colspan="2">{{ $key+1 }}. {{ date('Y-m-d H:i', strtotime($item->played_at)) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-right mheight">{{ $item->home->name }}</td>
                                                <td><input type="text" name="home" value="{{ $data['home'] }}" placeholder="{{ $item->home->name }}" class="form-control"></td>
                                            </tr>
                                            <tr>
                                                <td class="text-right mheight">{{ $item->visitor->name }}</td>
                                                <td><input type="text" name="visitor" value="{{ $data['visitor'] }}" placeholder="{{ $item->visitor->name }}" class="form-control"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="text-center">
                                                    <button type="submit" class="btn btn-success">Сохранить</button>
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
