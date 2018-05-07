@extends('FO.layout.app')
@section('imageUrl', '../img/event.JPG')
@section('content')
	<div class="container">
    @if(isset($event))
       <h2 style="text-align: center">Mise à Jour Evènement</h2>
       <form name="updateEvent" method="POST" action="/updateEvent/{{$event->id}}">
    @else
        <h2 style="text-align: center">Nouvel Evènement</h2>
	   <form name="createEvent" method="POST" action="/createEvent">
    @endif
	{!! csrf_field() !!}
        <div class="row control-group">
            <div class="form-group col-xs-12 floating-label-form-group controls">
                <label>Titre</label>
                <input type="text" class="form-control" placeholder="Titre" name="title" required="true" value="{{ isset($event->title) ? $event->title : ''}}">
                <p class="help-block text-danger"></p>
            </div>
        </div>
        <div class="row control-group">
            <div class="form-group col-xs-12 floating-label-form-group controls">
                <label>Contenu</label>
                <textarea rows="4" cols="50" name="content" class="form-control" placeholder="Contenu"  required="true">{{ isset($event->content) ? $event->content : ''}}</textarea> 
                <p class="help-block text-danger"></p>
            </div>
        </div>

        <div class="row control-group"> 
            	<label>Date et heure de début</label>
            <div class='input-group date col-sm-4' id='datetimepicker2'>
                <input type='text' class="form-control" name="startTime" value="{{ isset($event->start_time) ? \Carbon\Carbon::parse($event->start_time)->format('d/m/Y \\à H:i') : ''}}" required />
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
             	<label>Date et heure de fin</label>
             <div class='input-group date col-sm-4' id='datetimepicker'>
                <input type='text' class="form-control" name="endTime" value="{{ isset($event->end_time) ? \Carbon\Carbon::parse($event->end_time)->format('d/m/Y \\à H:i') : ''}}" required />
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
        <script type="text/javascript">
            $(function () {
                $('#datetimepicker2').datetimepicker({
                    locale: 'fr',
                });
            });
            $(function () {
                $('#datetimepicker').datetimepicker({
                    locale: 'fr',
                });
            });
        </script>
   		<div class="row control-group">
   			<select name="color" id="colorpicker" class="form-control required">
		        <option value="#7bd148">Green</option>
		        <option value="#5484ed">Bold blue</option>
		        <option value="#a4bdfc">Blue</option>
		        <option value="#46d6db">Turquoise</option>
		        <option value="#7ae7bf">Light green</option>
		        <option value="#51b749">Bold green</option>
		        <option value="#fbd75b">Yellow</option>
		        <option value="#ffb878">Orange</option>
		        <option value="#ff887c">Red</option>
		        <option value="#dc2127">Bold red</option>
		        <option value="#dbadff">Purple</option>
		        <option value="#e1e1e1">Gray</option>
		    </select>
		</div>
        <script type="text/javascript">
        	$(function () {
        	 	$('#colorpicker').simplecolorpicker({theme: 'glyphicons'});
        	 });
        </script>
        <div class="row control-group">
            <div class='input-group date col-sm-4'>
                <label for="sel1">Catégorie :</label>
                <select name="categorie" class="form-control required">
                    <option value="cours">Cours</option>
                    <option value="prestation">Prestation</option>
                    <option value="evenement_special">Evènement Spécial</option>
                </select>
            </div>
        </div>
        <br>
        <div id="success"></div>
        <div class="row">
            <div class="form-group col-xs-12">
                @if(isset($event))
        		    <input class="btn btn-default" type="submit" value="Mettre à jour">
                @else
                    <input class="btn btn-default" type="submit" value="Envoyer">
                @endif
            </div>
        </div>
    </form>
    @if(isset($event))
        <form method="POST" action='/deleteEvent/{{$event->id}}'>
            <input name="_method" type="hidden" value="DELETE">
            {!! csrf_field() !!}
            <input class="btn btn-danger" type="submit" value="Supprimer l'Evènement">
        </form>
    @endif
</div>
@endsection