@extends('FO.layout.app')
@section('title', 'Evenement Grenoble Samba Reggae')
@section('imageUrl', '../img/event.JPG')
@section('content')
  <div class="container">
  @if(Auth::check() && $bool === 0)
    @if (!\Carbon\Carbon::parse($event->start_time)->lt($currentDate))
        <form method="POST" action="/{{$event->id}}/participe">
          {!! csrf_field() !!}
          <input type="text" value='1' name="participe" hidden>
          <button class="btn btn-default pull-right">Je Participe</button>
        </form>
        <form method="POST" action="/{{$event->id}}/participe">
          {!! csrf_field() !!}
          <input type="text" value='0' name="participe" hidden>
          <button class="btn btn-default pull-right">Je ne participe pas</button>
        </form>
    @endif
  @endif

      @if(Auth::check() && $bool === 1)
        @if (!\Carbon\Carbon::parse($event->start_time)->lt($currentDate))
          <form method="POST" action="/{{$event->id}}/desinscription">
            {!! csrf_field() !!}
            <input type="text" value='0' name="participe" hidden>
            <button class="btn btn-default pull-right">Se Désinscrire</button>
          </form>
        @endif
      @elseif(Auth::check() && $bool === 2)
        @if (!\Carbon\Carbon::parse($event->start_time)->lt($currentDate))
          <form method="POST" action="/{{$event->id}}/desinscription">
            {!! csrf_field() !!}
            <input type="text" value='1' name="participe" hidden>
            <button class="btn btn-default pull-right">S'inscrire</button>
          </form>
        @endif
      @endif
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"> {{$event->title}}</h3>
      </div>
      <div class="panel-body">
         {{$event->content}}
      </div>
      <div class="panel-footer">
          <small>Heure de début :</small> le {{ \Carbon\Carbon::parse($event->start_time)->format('d/m/Y \\à H:i')}}<br>
          <small>Heure de Fin :</small> le {{ \Carbon\Carbon::parse($event->end_time)->format('d/m/Y \\à H:i')}}<br>
      </div>

    </div>

    @if(Auth::check())
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Liste des Participants</h3>
        </div>
        <div class="panel-body table-responsive">
          <table class="table table-hover">
              <thead>
                <tr>
                  <th>Prénom</th>
                  <th>Surnom</th>
                  <th>Instrument</th>
                </tr>
              </thead>
            @foreach($event->users as $user)
                @if($user->pivot->participe === 1)
                  <tbody>
                    <tr>
                      <td>{{$user->firstname}}</td>
                      <td>{{$user->nickname}}</td>
                      <td>{{$user->instrument}}</td>
                    </tr>
                  </tbody>
                @endif
              @endforeach
          </table>	
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Liste des Non-Participants</h3>
        </div>
        <div class="panel-body table-responsive">
          <table class="table table-hover">
              <thead>
                <tr>
                  <th>Prénom</th>
                  <th>Surnom</th>
                  <th>Instrument</th>
                </tr>
              </thead>
            @foreach( $event->users as $user)
                @if($user->pivot->participe === 0)
                  <tbody>
                    <tr>
                      <td>{{$user->firstname}}</td>
                      <td>{{$user->nickname}}</td>
                      <td>{{$user->instrument}}</td>
                    </tr>
                  </tbody>
                @endif
              @endforeach
          </table>
        </div>
      </div>
      <hr>
      <form method="POST" action="/comment/{{$event->id}}">
          {!! csrf_field() !!}
          <div class="form-group">
              <label for="comment">Laisser un Commentaire:</label>
              <textarea class="form-control" rows="5" name="content" required></textarea>
          </div>
          <input type="submit" value="Envoyer" class="btn btn-default">
      </form>
      <hr>
      @foreach($comments as $comment)
          <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">{{$comment->user->nickname}} ({{$comment->user->firstname}}) a écrit :<span class="pull-right badge" style="opacity: 0.8">{{\Carbon\Carbon::parse($comment->date)->format('d/m/Y \\à H:i')}}</span></h3>

              </div>
              <div class="panel-body">{{$comment->content}}</div>
          </div>
      @endforeach
      @endif
  </div>
@endsection