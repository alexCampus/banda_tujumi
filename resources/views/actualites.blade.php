@extends('layout.app')
@section('imageUrl', $imageUrl)
@section('content')
	<h1 style="text-align: center">Actualités</h1>
	<form method="GET" action="/createNews">
		<button class="btn btn-primary">Nouvelle News</button>
	</form>
	<hr>
	<article>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="post-preview">
					@foreach($news as $new)
						<h2>{{ $new->title }}</h2>
                        <p class='lead'>{{ $new->content }}</p>
						<p class="lead">posté le : <span class="glyphicon glyphicon-time"></span> {{ date('d-m-Y', strtotime($new->date)) }}</p>
						<hr>
					@endforeach
                    </div>
                </div>
        </div>
    </article>

    <hr>
@endsection