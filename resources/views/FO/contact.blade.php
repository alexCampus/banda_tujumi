@extends('FO.layout.app')
@section('imageUrl', $imageUrl)
@section('content')
	  <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <p></p>
                @if(Session::has('flash_message'))
                    <div class="col-md-6 col-md-offset-3 text-center wrap_title">
                            <div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {!! session('flash_message') !!}</em></div>
                    </div>
                @else
                    <form name="sentMessage" id="contactForm" method="POST" action="/contact" novalidate>
                    {!! csrf_field() !!}
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Nom</label>
                                <input type="text" class="form-control" placeholder="Votre Nom" id="name" name="name" required data-validation-required-message="Veuillez entrer votre nom.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Email</label>
                                <input type="email" class="form-control" placeholder="Votre Email" id="email" name="email" required data-validation-required-message="Veuillez entrer une adresse email valide.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Numéro de Téléphone</label>
                                <input type="tel" class="form-control" placeholder="Votre Numéro de Téléphone" id="phone" name="phonenumber" required data-validation-required-message="Veuillez entrer votre numero de téléphone.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Message</label>
                                <textarea rows="5" class="form-control" placeholder="Votre Message" id="message" name="message" required data-validation-required-message="Veuillez entrer votre message."></textarea>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <br>
                        <div id="success"></div>
                        <div class="row">
                            <div class="form-group col-xs-12">
                                <button type="submit" class="btn btn-default">Envoyer</button>
                            </div>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>

    <hr>
@endsection