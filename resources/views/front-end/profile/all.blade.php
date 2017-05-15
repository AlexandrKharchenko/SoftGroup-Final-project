@extends('layouts.app')

@section('content')
    <div class="container well-sm">

        <div class="row">
            <nav class="breadcrumb _profiler">
                <a class="breadcrumb-item" href="{{route('home')}}">Главная</a>

                <span class="breadcrumb-item active">Профили</span>
            </nav>
        </div>

        <div class="row wrap-grid-profile">
            @foreach($profiles as $profile)
                <div class="col-md-4 profile-item">
                    <div class="card">
                        @if($profile->photo)
                            <img class="card-img-top photo-profile" src="{{asset($profile->photo)}}" alt="Card image cap">
                        @endif
                        <div class="card-block">
                            <a href="{{route('user.profile.detail' , $profile->id)}}"><h5>{{$profile->first_name}} {{$profile->last_name}}</h5></a>
                            <a>GitHub: {{$profile->github_url}}</a>

                            <a href="{{route('user.profile.detail' , $profile->id)}}" class="btn btn-block btn-outline-info">Подробнее</a>
                        </div>
                    </div>
                </div>

            @endforeach


        </div>


        <div class="row">

                {{ $profiles->links('vendor.pagination.bootstrap-4') }}


        </div>

    </div>
@endsection