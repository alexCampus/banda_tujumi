@extends('layout.app')
@section('imageUrl', '../img/event.JPG')
@section('content')
	<div class="container">
    <h2 style="text-align: center">Mise à jour Actualités</h2>
	<form name="updateNews" method="POST" action="/updateNews/{{ $news->id }}">
	{!! csrf_field() !!}
        <div class="row control-group">
            <div class="form-group col-xs-12 floating-label-form-group controls">
                <label>Titre</label>
                <input type="text" class="form-control" placeholder="Titre" name="title" required="true" value='{{ $news->title }}'>
                <p class="help-block text-danger"></p>
            </div>
        </div>
        <div class="row control-group">
            <div class="form-group col-xs-12 floating-label-form-group controls">
                <label>Contenu</label>
                <textarea rows="4" cols="50" name="content" class="form-control" placeholder="Contenu"  required="true">{{ $news->content }}</textarea> 
                <p class="help-block text-danger"></p>
            </div>
        </div>

        
        <br>
        <div id="success"></div>
        <div class="row">
            <div class="form-group col-xs-12">
        		<input class="btn btn-default" type="submit" value="Envoyer">
            </div>
        </div>
    </form>
</div>
@endsection