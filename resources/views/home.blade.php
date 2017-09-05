@extends('layout.app')
@section('imageUrl', $imageUrl)
@section('content')
    <!-- Main Content -->
    <div class="container">
        <div class="row">
        
            <div class="col-lg-6 col-lg-offset-2  col-md-10 col-md-offset-1 ">
                <div class="post-preview">
                    <h2>La Banda Tujumi</h2>
                    <p>Nous sommes heureux de vous accueillir au sein des locaux du Prunier Sauvage.</p>
                    <p>Les cours se déroule tous les Lundi hors période de vacances scolaire.</p>
                    <p>18h45-20h15 : Batucada samba reggae – Atelier de rythmes brésiliens – Cours débutant et nouveaux arrivants</p>
                    <p>20h30-22h00 : Batucada samba reggae – Atelier de rythmes brésiliens – Cours confirmés</p>

                    <div class="full" class="content-area">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d44994.320601417916!2d5.680523141899465!3d45.18416019914046!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x478af48bd689be6f%3A0x618c10cd6e995398!2sGrenoble!5e0!3m2!1sfr!2sfr!4v1504623946319" width="100%" height="450" frameborder="0" style="border:0"></iframe>
                    </div>
                </div>                
            </div>
            <div class="col-lg-4 col-sm-12">
                <div class="well">
                    <h4>Actualités</h4>
                    <div class="row">
                        <div class="post-preview">
                            @foreach($news as $new)
                                <a href="/actualites">
                                    <h5>{{$new->title}}</h5>
                                    <small><em>
                                        @php
                                            echo substr($new->content,0,70)
                                        @endphp
                                        ....
                                    </em></small>
                                </a>
                                <hr>
                           @endforeach
                                
                        </div>
                    </div>
                </div>                
            </div>
        </div>
    </div>
@endsection
