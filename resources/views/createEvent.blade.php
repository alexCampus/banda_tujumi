@extends('layout.app')

@section('content')
	<h1>CreateEvent</h1>
	<div class="container">
	<form name="createEvent" method="POST" action="/createEvent">
	{!! csrf_field() !!}
        <div class="row control-group">
            <div class="form-group col-xs-12 floating-label-form-group controls">
                <label>Titre</label>
                <input type="text" class="form-control" placeholder="Titre" name="title" required="true">
                <p class="help-block text-danger"></p>
            </div>
        </div>
        <div class="row control-group">
            <div class="form-group col-xs-12 floating-label-form-group controls">
                <label>Contenu</label>
                <textarea rows="4" cols="50" name="content" class="form-control" placeholder="Contenu"  required="true"></textarea> 
                <p class="help-block text-danger"></p>
            </div>
        </div>

        <div class="row control-group">
            <div class="form-group col-xs-12 controls">
               <label><input type="checkbox" value="true" name="fullDay"> Jour Entier</label>
                <p class="help-block text-danger"></p>
            </div>
        </div>


        <div class="row control-group"> 
            	<label>Date et heure de début</label>
            <div class='input-group date col-sm-4' id='datetimepicker2'>
                <input type='text' class="form-control" name="startTime"/>
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
             	<label>Date et heure de fin</label>
             <div class='input-group date col-sm-4' id='datetimepicker'>
                <input type='text' class="form-control" name="endTime" />
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