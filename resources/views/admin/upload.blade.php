@extends('layout.app')
@section('imageUrl', '../img/galerie-grp.jpg')
@section('content')
	<div class="container">
		<div class="col-lg-offset-4 col-lg-4"> 
			<center><h1>Upload File</h1></center>
			<form action="{{ url('/uploadImages') }}" enctype="multipart/form-data" method="POST">
				{{ csrf_field() }}
				<div class="row">
					<div class="row control-group">
	                    <div class="form-group col-xs-12 floating-label-form-group controls">
	                        <label>Categorie</label>
	                        <input type="text" class="form-control" placeholder="Votre Categorie de Photo" name="categorie" required data-validation-required-message="Veuillez entrer une categorie d'image valide.">
	                        <p class="help-block text-danger"></p>
	                    </div>
	                    <div class="form-group col-xs-12 floating-label-form-group controls">
	                        <label>Titre</label>
	                        <input type="text" class="form-control" placeholder="Votre Titre de Photo" name="title" required data-validation-required-message="Veuillez entrer un titre valide.">
	                        <p class="help-block text-danger"></p>
	                    </div>
	                </div>
					<div class="col-md-12">
						<input type="file" name="image" required/>
					</div>
					<div class="col-md-12">
						<button type="submit" class="btn-sm btn-success">Upload</button>
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection