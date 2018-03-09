@extends('layout.app')
@section('imageUrl', $imageUrl)
@section('content')
	<div class="container">
		<div class="row">
	       	<div class="col-sm-offset-3 col-xs-12 col-sm-6 col-md-6">
	            <div class="well well-sm borderRadiusSm">
	                <div class="row">
	                    <div class="col-sm-6 col-md-8">
	                        <h4>{{$user->firstname}} {{$user->lastname}}</h4>
	                        <small><cite><i class="glyphicon glyphicon-user">
	                        </i> {{$user->nickname}} </cite></small>
	                        <p>
	                            <i class="glyphicon glyphicon-envelope"></i> {{$user->email}} 
	                            <br />
	                            <i class="glyphicon glyphicon-phone"></i> (+33){{$user->phonenumber}}
	                            <br />
	                            <i class="glyphicon glyphicon-oil"></i> {{$user->instrument}}
	                        </p>
	                        <!-- Split button -->
	                         <div class="btn-group">
								<a type="button" class="btn btn-primary" href="/updateProfil">
									Mettre à jour
								</a>

	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	    <hr>
		<div id="pattern" class="table-responsive">
			<h2 style="text-align: center">Evènements Inscrits</h2>
				<table class="table table-hover table-bordered ">
		  			<thead>
				      	<tr>
					        <th>Titre</th>
					        <th>Début</th>
				      </tr>
				    </thead>
				    <tbody>
					@foreach($events as $event)
	        			@if (!\Carbon\Carbon::parse($event->start_time)->lt(\Carbon\Carbon::now()))
						    <tr onclick="window.document.location='/agenda/{{$event->id}}';">
						        <td>{{$event->title}}</td>
						        <td>{{\Carbon\Carbon::parse($event->start_time)->format('d/m/Y')}}</td>
						        <td>
						        	@if(Auth::check())
								          <form method="POST" action="/{{$event->id}}/desinscription">
								            {!! csrf_field() !!}
								            <button class="btn-sm btn-default pull-right">Se Désinscrire</button>
								          </form>
								        @endif
								</td>
					    	</tr>
						@endif
					@endforeach
			    	</tbody>
				</table>
		</div>
	</div>
@endsection

@section('script')
	<script>
        function getUpdatePath() {
            window.location.replace('/updateProfil')
        }
	</script>
@endsection

