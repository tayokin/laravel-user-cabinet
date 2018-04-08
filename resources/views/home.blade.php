@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="jumbotron">
                    <h2>Добро пожаловать <b>{{ Auth::user()->name }}</b>!</h2>
                    <div class="card">
                        <div class="card-body">
                            <h5>Список зарегестрированных пользователей</h5>
                            @foreach($users as $user)
                                <ul class="list-group">
                                    @if(Auth::user() == $user)
                                        <li class="list-group-item active">
                                            <span class="badge">id:{{ $user->id }}</span>
                                            <b>Вы</b>: {{ $user->name }}
                                        </li>
                                    @else
                                        <li class="list-group-item">
                                            <span class="badge">id:{{ $user->id }}</span>
                                            {{ $user->name }}
                                        </li>
                                    @endif
                                </ul>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
