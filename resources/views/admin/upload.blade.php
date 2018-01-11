@extends('layout.app')
@section('imageUrl', '../img/galerie-grp.jpg')
@section('content')
	<div class="container">
		<div class="col-lg-offset-4 col-lg-4">
			@if (session('status'))
				<div class="alert alert-danger">
					{{ session('status') }}
				</div>
			@endif
			<center><h1>Upload File</h1></center>
			<form action="{{ url('/uploadImages') }}" enctype="multipart/form-data" method="POST">
				{{ csrf_field() }}
				<div class="row">
					<div class="row control-group">
	                    <div class="form-group col-xs-12">
	                        <label>Categorie</label>
	                        <input type="text" class="form-control" placeholder="Votre Categorie de Photo" id="categorieInput" name="categorieInput"  data-validation-required-message="Veuillez entrer une categorie d'image valide.">

							{{--@TODO Erreur car value select vide faire control permettant de verifier si on prend le champ input ou le camp select--}}
							<label for="sel1">Ou bien choissisez une Categorie Existante</label>
							<select class="form-control" name="categorieSelect" id="categorieSelect">
									<option value=''></option>
								@foreach($categories as $key => $cat)
									<option value="{{ $key  }}">{{ $key }}</option>
								@endforeach
							</select>
							<p class="help-block text-danger"></p>
						</div>
	                    <div class="form-group col-xs-12 floating-label-form-group controls">
	                        <label>Titre</label>
	                        <input type="text" class="form-control" placeholder="Votre Titre de Photo" name="title" required data-validation-required-message="Veuillez entrer un titre valide.">
	                        <p class="help-block text-danger"></p>
	                    </div>
	                </div>
					<div class="col-md-12" style="padding-top: 5%">
						<input type="file" name="image" required/>
					</div>
					<div class="col-md-12" style="padding-top: 5%">
						<button type="submit" class="btn-sm btn-success">Upload</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<script>
		$(document).ready(function() {
		    let categorieInput = $('#categorieInput');
		    let categorieSelect = $('#categorieSelect');

			categorieSelect.change(function() {
			    if(categorieSelect.val() != '') {
                    categorieInput.val('');
				}

			})
		});
	</script>
@endsection