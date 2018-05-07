@extends('BO.layout.app')
@section('content')
    <div class="jumbotron">
        <div class="container">
            <h2 style="text-align: center">Nouvelle Actualité</h2>
            <form name="createNews" method="POST" action="/createNews" novalidate>
                {!! csrf_field() !!}
                <div class="row control-group">
                    <div class="form-group col-xs-12 floating-label-form-group controls">
                        <label>Titre</label>
                        <input type="text" class="form-control" placeholder="Titre" name="title" required="true">
                        <p class="help-block text-danger"></p>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-12 floating-label-form-group">
                        <label>Contenu</label>
                        <textarea rows="4" cols="50" name="content" placeholder="Contenu"  required="true"></textarea>
                        <p class="help-block text-danger"></p>
                    </div>
                </div>

                <div class="row form-group col-md-2">
                    <select name="isPrivate" class="form-control">
                        <option value="0">Public</option>
                        <option value="1">Prive</option>
                    </select>
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
    </div>

	               
@endsection

@section('script')
    <script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
    <script>tinymce.init({
            selector:'textarea',
            height : 300,
            language : "fr_FR",
            branding: false,
            plugins: [
                'advlist autolink lists link image charmap print preview anchor textcolor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table contextmenu paste code help wordcount'
            ],
            toolbar: 'insert | undo redo |  formatselect | bold italic forecolor backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
        });</script>
@endsection