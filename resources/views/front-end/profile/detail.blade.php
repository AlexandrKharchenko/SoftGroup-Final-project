@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <nav class="breadcrumb _profiler">
            <a class="breadcrumb-item" href="{{route('home')}}">Главная</a>
            <a class="breadcrumb-item" href="{{route('user.profile.lists')}}">Профили</a>
            <span class="breadcrumb-item active">Профиль: {{$profile->first_name}} {{$profile->last_name}}</span>
        </nav>
    </div>

    <div class="row wBg">
        <div class="col-md-4">
            <div class="card card-gray">
                @if($profile->photo)
                    <img class="card-img-top photo-profile" src="{{asset($profile->photo)}}" alt="Card image cap">
                @endif
                <div class="card-block">

                    <h5>{{$profile->first_name}} {{$profile->last_name}} {{$profile->middle_name}}</h5>
                    <ul class="list-unstyled">
                        <li><i class="fa fa-github" aria-hidden="true"></i>  <a href="{{$profile->github_url}}">GitHub</a></li>
                        <li><i class="fa fa-mobile" aria-hidden="true"></i> Телефон: {{$profile->phone}}</li>
                        <li><i class="fa fa-envelope-o" aria-hidden="true"></i> Email: {{$profile->user->email}}</li>
                    </ul>

                    <like-profile :profileid="{{$profile->id}}"></like-profile>
                </div>
            </div>
        </div>
        <div class="col-md-8">

            <h4>О себе:</h4>
            <p>{{$profile->about}}</p>

        </div>
    </div>
</div>





@endsection