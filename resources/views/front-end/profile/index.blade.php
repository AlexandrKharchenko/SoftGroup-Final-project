@extends('layouts.app')

@section('content')
    <div class="container well-sm">
        <div class="row">
            <nav class="breadcrumb _profiler">
                <a class="breadcrumb-item" href="{{route('home')}}">Главная</a>
                <a class="breadcrumb-item" href="{{route('user.account.index')}}">Аккаунт</a>
                <span class="breadcrumb-item active">Профиль</span>
            </nav>
        </div>

        <user-profile></user-profile>

    </div>
@endsection