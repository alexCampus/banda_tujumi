@extends('layout.app')
@section('imageUrl', $imageUrl)
@section('content')
    <!-- Main Content -->
    <div class="container">
        <div class="row">
        
            <div class="col-lg-6 col-lg-offset-2  col-md-10 col-md-offset-1 ">
                <div class="post-preview">
                    <h2>La Banda Tujumi</h2>
                    <p>La Banda Tujumi est une association loi de 1901 de percussions afro-brésilienne (appelée plus communément  batucada de samba-reggae). Les cours sont dispensés les lundis au sein des locaux de la maison des                               Moaïs sur la commune de Saint Martin le Vinoux (38).</p>
                    <p>Cette batucada a le souhait de développer les rythmes brésiliens dans toute l’agglomération Grenobloise et plus largement encore. Elle propose donc son atelier samba-reggae, unique sur l’agglo, tous les lundis mais également, elle vous propose d’animer vos évènements sur scène ou pour des défilés, carnavals…</p>
                    <p>Enfin, des stages peuvent être proposés pour des échanges avec d’autres groupes de percussions mais aussi pour des initiations pour des MJC, comités d’entreprises….</p>

                    <div class="full" class="content-area">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d44994.320601417916!2d5.680523141899465!3d45.18416019914046!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x478af48bd689be6f%3A0x618c10cd6e995398!2sGrenoble!5e0!3m2!1sfr!2sfr!4v1504623946319" width="100%" height="450" frameborder="0" style="border:0"></iframe>
                    </div>
                </div>                
            </div>
            <div class="col-lg-4 col-sm-12">
                <div class="well colorBlock">
                    <h4>Actualités</h4>
                    <div class="row">
                        <div class="post-preview">
                                <a href="/actualites">
                                    <h5>{{$news->title}}</h5>
                                    <small><em>
                                        @php
                                            echo substr($news->content,0,70)
                                        @endphp
                                        ....
                                    </em></small>
                                </a>
                                <hr>                            
                        </div>
                    </div>
                </div>                
            </div>
        </div>
    </div>
@endsection
