@extends('BO.layout.app')

@section('content')

    <div class="jumbotron">
        <h1 style="text-align: center">Actualités</h1>
        <ul class="nav nav-pills pull-right" >
            <li role="presentation">
                <a href="/createNews" class="btn btn-primary active">Nouvelle Actualité</a>
            </li>
        </ul>
    </div>

    @foreach($news as $new)
        <div class="col-lg-4" style="height: 500px; overflow: auto; border: #0d3625 solid 1px">
            <h2>{{ $new->title }}</h2>
            <span class="label label-default pull-right">{{ $new->isPrivate === 0 ? 'Public' : 'Privé' }}</span>
            <p class='lead'>{!! $new->content !!}</p>
            <p class="lead">posté le : <span class="glyphicon glyphicon-time"></span> {{ date('d-m-Y', strtotime($new->date)) }}</p>
            @if (Auth::check() && Auth::user()->adminLevel > 0)
                <div class="pull-right">
                    <a href="/updateNews/{{$new->id}}" class="btn btn-warning">Mettre a Jour</i></a>
                    <form method="POST" action='/deleteNews/{{$new->id}}'>
                        <input name="_method" type="hidden" value="DELETE">
                        {!! csrf_field() !!}
                        <input class="btn btn-danger" type="submit" value="Supprimer">
                    </form>
                    {{--<a href="/deleteNews/{{$new->id}}" style="color:#a8534b"><i class="fa fa-minus-circle" aria-hidden="true">Supprimer</i></a>--}}
                </div>
            @endif
        </div>
    @endforeach
@endsection