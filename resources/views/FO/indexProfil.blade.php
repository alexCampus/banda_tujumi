@extends('FO.layout.app')
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
								<a type="button" class="btn btn-primary" href="/updateProfil" style="border-radius: 20px 20px 20px">
                                    Mettre à jour
                                </a>
	                        </div>
							<div class="btn-group">
								<a type="button" class="btn-sm btn-danger" onclick="return confirm('Attention votre compte sera définitivement supprimé. Etes vous sûr de vouloir supprimer votre compte ?')" href="/deleteProfil" style="margin-top:1%;border-radius: 20px 20px 20px">
									Supprimer mon profil
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
							@if($event->pivot->participe === 1)
								<tr onclick="window.document.location='/agenda/{{$event->id}}';">
									<td>{{$event->title}}</td>
									<td>{{\Carbon\Carbon::parse($event->start_time)->format('d/m/Y')}}</td>
									<td>
										@if(Auth::check())
											  <form method="POST" action="/{{$event->id}}/desinscription">
												{!! csrf_field() !!}
												<input type="text" value='0' name="participe" hidden>
												<button class="btn-sm btn-default pull-right">Se Désinscrire</button>
											  </form>
											@endif
									</td>
								</tr>
							@endif
						@endif
					@endforeach
			    	</tbody>
				</table>
		</div>
	</div>
@endsection
