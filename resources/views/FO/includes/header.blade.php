<!-- Page Header -->
<!-- Set your background image for this header on the line below. -->
<header class="intro-header" style="background-image: url(@yield('imageUrl')); min-height: 500px" >
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <div class="site-heading">
                    <h1>Banda Tujumi</h1>
                    <hr class="small">
                    <span class="subheading">Le meilleur du Samba Reggae sur Grenoble</span>
                </div>
                @if(Session::has('success'))
                    <div class="alert alert-error">
                        {{Session::get('success')}}
                    </div>
                @endif
            </div>
        </div>
    </div>
</header>