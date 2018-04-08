@extends('layouts.app')

@section('js')
    @parent
    <script src="{{ asset('js/auth.js') }}" defer></script>
@endsection

@section('css')
    @parent
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="form">
                    <ul class="tab-group">
                        <li class="tab active"><a href="#login">Вход</a></li>
                        <li class="tab active"><a href="#register">Регистрация</a></li>
                    </ul>
                    <div class="tab-content">
                        @include('auth.login-tab')
                        @include('auth.register-tab')
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
