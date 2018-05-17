@extends('BO.layout.app')

@section('content')

    <div class="jumbotron">
        <h1 style="text-align: center">Médias</h1>
        <ul class="nav nav-pills pull-right" >
            <li role="presentation">
                <a href="/uploadImages" class="btn btn-primary active" style="">Ajouter des Images</a>
                <a href="/deleteImages" class="btn btn-danger active">Supprimer des Images</a>
            </li>
        </ul>
    </div>
    <div class="container">
        <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
            <div class="slides"></div>
            <h3 class="title"></h3>
            <a class="prev">‹</a>
            <a class="next">›</a>
            <a class="play-pause"></a>
            <ol class="indicator"></ol>
        </div>
        <div class="row">
            @foreach($categorie as $key => $cat)
                <div id="links_{{ $key }}" class="col-md-4">
                    <h2>{{ $key }} </h2>
                    <button type="button" class="btn btn-default btn-sm" style="border-radius: 50px 50px 50px">
                        <span class="glyphicon glyphicon-picture"></span>
                    </button>
                    @foreach($cat as $image)
                        @if($image->categorie === $key)
                            <a href='/storage/{{ $image->categorie }}/{{ $image->name }}' title="{{ $image->title }}">
                            <!-- <img src="storage/{{ $image->categorie }}/{{ $image->name }}" alt="{{ $image->title }}" style="max-height:100px"> -->
                            </a>
                        @endif
                    @endforeach
                </div>
            @endforeach
        </div>
        <script>
            var cat =  {!! json_encode($categorie) !!};
            Object.keys(cat).forEach(function (c) {
                document.getElementById('links_'+c).onclick = function (event) {
                    event = event || window.event;
                    var target = event.target || event.srcElement,
                        link = target.src ? target.parentNode : target,
                        options = {index: link, event: event},
                        links = this.getElementsByTagName('a');
                    blueimp.Gallery(links, options);
                };
            });

        </script>
    </div>
    {{--@foreach($events as $event)--}}
        {{--<div class="col-lg-4" style="height: 500px; overflow: auto; border: #0d3625 solid 1px">--}}
            {{--<h2>{{ $event->title }}</h2>--}}
            {{--<span class="label label-default pull-right">{{ $event->isPrivate === 0 ? 'Public' : 'Privé' }}</span>--}}
            {{--<p class='lead'>{!! $event->content !!}</p>--}}
            {{--<p class="lead">débute le : <span class="glyphicon glyphicon-time"></span> {{ date('d-m-Y à H:i', strtotime($event->start_time)) }}</p>--}}
            {{--<p class="lead">finie le : <span class="glyphicon glyphicon-time"></span> {{ date('d-m-Y à H:i', strtotime($event->end_time)) }}</p>--}}
            {{--@if (Auth::check() && Auth::user()->adminLevel > 0)--}}
                {{--<div class="pull-right">--}}
                    {{--<a href="/updateEvent/{{$event->id}}" class="btn btn-warning">Mettre a Jour</a>--}}
                    {{--<form method="POST" action='/deleteEvent/{{$event->id}}'>--}}
                        {{--<input name="_method" type="hidden" value="DELETE">--}}
                        {{--{!! csrf_field() !!}--}}
                        {{--<input class="btn btn-danger" type="submit" value="Supprimer">--}}
                    {{--</form>--}}
                {{--</div>--}}
            {{--@endif--}}
        {{--</div>--}}
    {{--@endforeach--}}
@endsection