@extends('FO.layout.app')
@section('imageUrl', 'img/accueil.jpg')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">S'enregistrer</div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="/updateProfil">
                            {!! csrf_field() !!}
                            <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                                <label for="lastname" class="col-md-4 control-label">Nom</label>

                                <div class="col-md-6">
                                    <input id="lastname" type="text" class="form-control" name="lastname" value="{{ $user->lastname }}" placeholder="Nom" required autofocus>

                                    @if ($errors->has('lastname'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                                <label for="firstname" class="col-md-4 control-label">Prénom</label>

                                <div class="col-md-6">
                                    <input id="firstname" type="text" class="form-control" name="firstname" value="{{ $user->firstname }}" placeholder="Prénom" required autofocus>

                                    @if ($errors->has('firstname'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('firstname') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('nickname') ? ' has-error' : '' }}">
                                <label for="nickname" class="col-md-4 control-label">Surnom</label>

                                <div class="col-md-6">
                                    <input id="nickname" type="text" class="form-control" name="nickname" value="{{ $user->nickname }}" placeholder="Surnom donné par Bira" required autofocus>

                                    @if ($errors->has('nickname'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('nickname') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" placeholder="E-Mail" required>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('phonenumber') ? ' has-error' : '' }}">
                                <label for="phonenumber" class="col-md-4 control-label">N° de Téléphone </label>

                                <div class="col-md-6">
                                    <input id="phonenumber" type="phonenumber" class="form-control" name="phonenumber" value="{{ $user->phonenumber }}" placeholder="0600000000" required maxlength="10">

                                    @if ($errors->has('phonenumber'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('phonenumber') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('instrument') ? ' has-error' : '' }}">
                                <label for="instrument" class="col-md-4 control-label">Instrument</label>

                                <div class="col-md-6">
                                    <input id="instrument" type="text" class="form-control" name="instrument" value="{{ $user->instrument }}" placeholder="Instrument Principal" required>

                                    @if ($errors->has('instrument'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('instrument') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="emailRadio" class="col-md-4 control-label">Gestion E-mails</label>

                                <div class="col-md-6">
                                    <div class="radio">
                                        <label style="font-weight: 100; font-size: medium;"><input type="radio" name="emailRadio" value="0" {{Auth::user()->adminLevel >= 0 ? 'checked' : ''}}>Recevoir tous les e-mails</label>
                                    </div>
                                    <div class="radio">
                                        <label style="font-weight: 100; font-size: medium;"><input type="radio" name="emailRadio" value="-1" {{Auth::user()->adminLevel === -1 ? 'checked' : ''}}>Recevoir que les actualités</label>
                                    </div>
                                    <div class="radio disabled">
                                        <label style="font-weight: 100; font-size: medium;"><input type="radio" name="emailRadio" value="-10" {{Auth::user()->adminLevel < -2 ? 'checked' : ''}}>Recevoir aucun e-mail</label>
                                    </div>



                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        envoyer
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
