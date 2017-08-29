@extends('layout.app')
@section('imageUrl', 'img/accueil.jpg')
@section('content')
<div class="container">
<h2 style="text-align: center">Admin</h2>
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
            <th>Up</th>
            <th>Down</th>
          </tr>
        </thead>
    	@foreach($users as $user)
            <tbody>
              <tr>
                <td>{{$user->lastname}}</td>
                <td>{{$user->firstname}}</td>
                <td>{{$user->nickname}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->phonenumber}}</td>
                <td>{{$user->instrument}}</td>
                <td>{{$user->adminLevel}}</td>
                <td><a href="/upGradeAdminLevel/{{$user->id}}"><i class="fa fa-plus" aria-hidden="true"></i></a></td>
                <td><a href="/downGradeAdminLevel/{{$user->id}}"><i class="fa fa-minus" aria-hidden="true"></i></a></td>
              </tr>
            </tbody>
        @endforeach
    </table>
</div>
	               
@endsection