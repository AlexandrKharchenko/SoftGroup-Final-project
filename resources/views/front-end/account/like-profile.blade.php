@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <nav class="breadcrumb _profiler">
                <a class="breadcrumb-item" href="{{route('home')}}">Главная</a>
                <a class="breadcrumb-item" href="{{route('user.account.index')}}">Аккаунт</a>
                <span class="breadcrumb-item active">Закладки</span>
            </nav>
        </div>
    </div>





@endsection