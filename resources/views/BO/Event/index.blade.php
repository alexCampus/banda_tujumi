@extends('BO.layout.app')

@section('content')

    <div class="jumbotron">
        <h1 style="text-align: center">Prestations</h1>
        <ul class="nav nav-pills pull-right" >
            <li role="presentation">
                <a href="/createEvent" class="btn btn-primary active">Nouvelle Prestation</a>
            </li>
        </ul>
    </div>

    @foreach($events as $event)
        <div class="col-lg-4" style="height: 500px; overflow: auto; border: #0d3625 solid 1px">
            <h2>{{ $event->title }}</h2>
            <span class="label label-default pull-right">{{ $event->categorie }}</span>
            <p class='lead'>{!! $event->content !!}</p>
            <p class="lead">débute le : <span class="glyphicon glyphicon-time"></span> {{ date('d-m-Y à H:i', strtotime($event->start_time)) }}</p>
            <p class="lead">finie le : <span class="glyphicon glyphicon-time"></span> {{ date('d-m-Y à H:i', strtotime($event->end_time)) }}</p>
            @if (Auth::check() && Auth::user()->adminLevel > 0)
                <div class="pull-right">
                    <a href="/updateEvent/{{$event->id}}" class="btn btn-warning">Mettre a Jour</a>
                    <form method="POST" action='/deleteEvent/{{$event->id}}'>
                        <input name="_method" type="hidden" value="DELETE">
                        {!! csrf_field() !!}
                        <input class="btn btn-danger" type="submit" value="Supprimer">
                    </form>
                </div>
            @endif
        </div>
    @endforeach
@endsection