@extends('layout.app')

@section('content')
	<h1>Actualités</h1>
	<form method="GET" action="/createNews">
		<button class="btn btn-primary">Nouvelle News</button>
	</form>
	@foreach($news as $new)
		{{ $new->title }}<br>
		{{ $new->content }}<br>
		{{ date('d-m-Y', strtotime($new->date)) }}
		<hr>
	@endforeach
@endsection