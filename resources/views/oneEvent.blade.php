@extends('layout.app')
@section('imageUrl', '../img/event.JPG')
@section('content')
  <div class="container">
  @if(Auth::check() && $bool === false)
        <form method="POST" action="/{{$event->id}}/participe">
          {!! csrf_field() !!}
          <button class="btn-sm btn-default pull-right">S'Inscrire</button>
        </form>
      @endif

      @if(Auth::check() && $bool === true)
        <form method="POST" action="/{{$event->id}}/desinscription">
          {!! csrf_field() !!}
          <button class="btn-sm btn-default pull-right">Se Désinscrire</button>
        </form>
      @endif
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"> {{$event->title}}</h3>
      </div>
      <div class="panel-body">
         {{$event->content}}
      </div>
      <div class="panel-footer">
      @if (Auth::check() && Auth::user()->adminLevel > 0)
        <a class="pull-right" href="/updateEvent/{{$event->id}}" style="color:#a8534b"><i class="fa fa-plus" aria-hidden="true"> Mettre a Jour</i></a>
      @endif
          <small>Heure de début :</small> le {{ \Carbon\Carbon::parse($event->start_time)->format('d/m/Y \\à H:i')}}<br>
          <small>Heure de Fin :</small> le {{ \Carbon\Carbon::parse($event->end_time)->format('d/m/Y \\à H:i')}}<br>
      </div>

    </div>
    
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Liste des Inscrits</h3>   
      </div>
      <div class="panel-body">
        <table class="table table-hover">
            <thead>
              <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Surnom</th>
                <th>Instrument</th>
              </tr>
            </thead>
          @foreach( $event->users as $user)
                <tbody>
                  <tr>
                    <td>{{$user->lastname}}</td>
                    <td>{{$user->firstname}}</td>
                    <td>{{$user->nickname}}</td>
                    <td>{{$user->instrument}}</td>
                  </tr>
                </tbody>
            @endforeach
        </table>	
      </div>
    </div>
  </div>
@endsection