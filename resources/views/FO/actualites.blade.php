@extends('FO.layout.app')
@section('imageUrl', $imageUrl)
@section('content')
	<div class="container">
		<h2 style="text-align: center">Actualités</h2>
		<hr>
		<article>
            <div class="row">
                <div class="col-lg-6 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="post-preview">
					@foreach($news as $new)
						<h2>{{ $new->title }}</h2>
                        <p class='lead'>{!! $new->content !!}</p>
						<p class="lead">posté le : <span class="glyphicon glyphicon-time"></span> {{ date('d-m-Y', strtotime($new->date)) }}</p>
						<hr>
					@endforeach
                    </div>
                </div>
            </div>
    	</article>
    </div>

@endsection