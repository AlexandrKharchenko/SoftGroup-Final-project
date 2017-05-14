@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row wBg">
        <div class="col-md-4">
            <div class="card card-gray">
                <img class="card-img-top" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22318%22%20height%3D%22180%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20318%20180%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_15bf92ef114%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A16pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_15bf92ef114%22%3E%3Crect%20width%3D%22318%22%20height%3D%22180%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22118.0859375%22%20y%3D%2297.2%22%3E318x180%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" alt="Card image cap">
                <div class="card-block">

                    <h5>{{$profile->first_name}} {{$profile->last_name}} {{$profile->middle_name}}</h5>
                    <ul class="list-unstyled">
                        <li><i class="fa fa-github" aria-hidden="true"></i>  <a href="{{$profile->github_url}}">GitHub</a></li>
                        <li><i class="fa fa-mobile" aria-hidden="true"></i> Телефон: {{$profile->phone}}</li>
                        <li><i class="fa fa-envelope-o" aria-hidden="true"></i> Email: {{$profile->email}}</li>
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