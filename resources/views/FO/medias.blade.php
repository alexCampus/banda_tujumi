@extends('FO.layout.app')
@section('imageUrl', $imageUrl)
@section('content')
	<div class="container">
		<h2 style="text-align: center">Médias</h2>
		<hr>

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
							<a href='storage/{{ $image->categorie }}/{{ $image->name }}' title="{{ $image->title }}">
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
@endsection