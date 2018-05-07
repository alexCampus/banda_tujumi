@extends('FO.layout.app')
@section('imageUrl', '../img/galerie-grp.jpg')
@section('content')
	<div class="container">
		<center><h1>Supprimer Images</h1></center>
		<hr>
		<div class="row">
			@foreach($categorie as $key => $cat)
				<div class="row">
					<h2>{{ $key }} </h2>
					@foreach($cat as $image)
							@if($image->categorie === $key)
								<div  style="text-align: center; max-width: 120px;" class="col-md-2 col-md-offset-1" >
									<img src="storage/{{ $image->categorie }}/{{ $image->name }}" alt="{{ $image->title }}" style="max-height:100px">
									<form method="post" action="/deleteImages/{{ $image->id }}">
										{{ csrf_field() }}
										<input type="hidden" name="img" value="/public/{{$image->categorie}}/{{$image->name}}">
										<button type="submit" class="btn-xs btn-danger">Supprimer</button>
									</form>
								</div>
							@endif
					@endforeach
				</div>
			@endforeach
		</div>
	</div>
@endsection