@extends('BO.layout.app')

@section('content')
    <div class="jumbotron">
        <h1 style="text-align: center">Utilisateurs</h1>
    </div>
    <div class="container">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Surnom</th>
                <th>Email</th>
                <th>N° de Téléphone</th>
                <th>Instrument</th>
                <th>adminLevel</th>
                @if(Auth::user()->adminLevel === 3)
                    <th>Up</th>
                    <th>Down</th>
                @endif
            </tr>
            </thead>
            @foreach($users as $user)
                <tbody>
                <tr>
                    <td>{{$user->lastname}}</td>
                    <td>{{$user->firstname}}</td>
                    <td>{{$user->nickname}}</td>
                    <td>{{$user->email}}</td>
                    <td>0{{$user->phonenumber}}</td>
                    <td>{{$user->instrument}}</td>
                    <td>{{$user->adminLevel}}</td>
                    @if(Auth::user()->adminLevel === 3)
                        <td><a href="/upGradeAdminLevel/{{$user->id}}"><i class="fa fa-plus" aria-hidden="true"></i></a></td>
                        <td><a href="/downGradeAdminLevel/{{$user->id}}"><i class="fa fa-minus" aria-hidden="true"></i></a></td>
                    @endif
                </tr>
                </tbody>
            @endforeach
        </table>
        @if(Auth::user()->adminLevel === 3 )
            <form action="/newUser" method="POST">
                {!! csrf_field() !!}
                <label>New User</label>
                <input type="email" name="email" placeholder="email" required>
                <button class="btn-sm btn-default" type="submit">Submit</button>
            </form>
        @endif
    </div>

	               
@endsection