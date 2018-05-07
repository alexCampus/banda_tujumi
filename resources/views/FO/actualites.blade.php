@extends('FO.layout.app')
@section('imageUrl', $imageUrl)
@section('content')
	<div class="container">
		<h2 style="text-align: center">Actualités</h2>
		@if (Auth::check() && Auth::user()->adminLevel > 0)
			<ul class="nav nav-pills pull-right" >
	  			<li role="presentation" ><a href="/createNews"><i class="fa fa-plus" aria-hidden="true"> News</i></a></li>
			</ul>
		@endif
		<hr>
		<article>
            <div class="row">
                <div class="col-lg-6 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="post-preview">
					@foreach($news as $new)
						<h2>{{ $new->title }}</h2>
                        <p class='lead'>{!! $new->content !!}</p>
						<p class="lead">posté le : <span class="glyphicon glyphicon-time"></span> {{ date('d-m-Y', strtotime($new->date)) }}</p>
						@if (Auth::check() && Auth::user()->adminLevel > 0)
							<a href="/updateNews/{{$new->id}}" style="color:#a8534b"><i class="fa fa-plus" aria-hidden="true"> Mettre a Jour</i></a></li>
						@endif
						<hr>
					@endforeach
                    </div>
                </div>
            </div>
    	</article>
    </div>

@endsection