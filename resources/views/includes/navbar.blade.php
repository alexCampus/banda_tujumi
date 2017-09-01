<!-- Navigation -->
<nav class="navbar navbar-default navbar-custom navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                Menu <i class="fa fa-bars"></i>
            </button>
           @if (Route::has('login'))
                    @if (Auth::check())
                        <div class="dropdown" >
                            <a class="btn dropdown-toggle colorBlack"  data-toggle="dropdown">
                            @if( Auth::user()->nickname ) 
                                    {{ Auth::user()->nickname }}
                            @else 
                                    {{ Auth::user()->firstname }}
                            @endif
                            </a>
                            <span class="caret"></span>
                            <ul class="dropdown-menu colorBlack">
                                <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
                            </ul>
                        </div>
                            

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
                    @else
                        <a class="btn dropdown-toggle colorBlack" onclick="window.location.href='/login'">Se Connecter</a>
                            
                    @endif
                @endif
        

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="/">Accueil</a>
                </li>
                <li>
                    <a href="/presentation">Présentation</a>
                </li>
                <li>
                    <a href="/actualites">Actualités</a>
                </li>
                <li>
                    <a href="/medias">Médias</a>
                </li>
                <li>
                    <a href="/prestation">Prestations</a>
                </li>
                <li>
                    <a href="/agenda">Agenda</a>
                </li>
                <li>
                    <a href="/contact">Contact</a>
                </li>
                @if(Auth::check() && Auth::user()->adminLevel === 3)
                    <li>
                        <a href="/adminUser">Admin User</a>
                    </li>
                @endif
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    </div>
    <!-- /.container -->
</nav>
