<section id="header">
    <header>
        <div class="top-bar">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 responsive-width-top">
                        <div class="social">
                            <div class="social-icon">
                                <a href="https://www.facebook.com/maakiti" target="_blank"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-google-plus"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                                <a href="#"><i class="fa fa-dribbble"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 responsive-width-top">
                        <div class="links text-right">
                            <a href="#"></a>
                            @if(Auth::user())
                              <ul class="nav navbar-right">
                                <li class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                      {{Auth::user()->name}}  <i class="fa fa-caret-down"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-user" style="background-color: #535353;margin-top: 0px;">
                                      <li>
                                         <a href="{{ url('publier-annonce') }}"><i class="fa fa-edit"></i> Publier une annonce</a>
                                      </li>
                                        <li>
                                           <a href="{{ url('mon-compte') }}"><i class="fa fa-home"></i> Mon compte</a>
                                        </li>
                                        <li class="divider"></li>
                                          <li><a href="{{ url('se-deconnecter') }}"><i class="fa fa-sign-out"></i> Se deconnecter</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                            @else
                                <a href="{{ url('se-connecter') }}">Se connecter</a>
                                <a href="{{ url('publier-annonce') }}">Publier une annonce</a>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div><!--end top bar-->

        <!--start menu-bar-->
        <div class="menu-bar">
            <div class="container">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="logo">
                            <a href="{{ url('/')}}"><img src="{{ asset('images/logo.png') }}" alt="{{ config('application.name') }}"></a>
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <nav role="navigation" class="navbar navbar-default">
                            <!-- Brand and toggle get grouped for better mobile display -->
                            <div class="navbar-header">
                                <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                            <!-- Collection of nav links and other content for toggling -->
                            <div id="navbarCollapse" class="collapse navbar-collapse">
                                <ul class="nav navbar-nav navbar-right">
                                    <li class="{{ Request::is( '/') ? 'active' : '' }}"><a  href="{{ url('') }}">Accueil</a>
                                    <li class="{{ Request::is( 'annonces/offres') ? 'active' : '' }}"><a  href="{{ url('annonces/offres') }}">Offres</a>
                                    <li class="{{ Request::is( 'annonces/demandes') ? 'active' : '' }}"><a  href="{{ url('annonces/demandes') }}">Demandes</a>
                                    <li class="{{ starts_with('boutique',Request::segment(1) )? 'active' : '' }} {{ starts_with('boutiques',Request::segment(1) )? 'active' : '' }}"><a href="{{ url('boutiques') }}">Boutiques</a></li>
                                    <li class="dropdown {{ Request::is('qui-sommes-nous') ? 'active' : '' }}{{ Request::is('regles-generales') ? 'active' : '' }}{{ Request::is('compte-professionel') ? 'active' : '' }}{{ Request::is('faq') ? 'active' : '' }}">
                                        <a class="dropdown-toggle" href="#">A propos de Maakiti</a>
                                        <ul class="dropdown-menu sub-menu">
                                            <li><a href="{{ url('qui-sommes-nous') }}">Qui sommes nous?</a></li>
                                            <li><a href="{{ url('regles-generales') }}">Règles générales</a></li>
                                            <li><a href="{{ url('compte-professionel') }}">Comptes professionels</a></li>
                                            <li><a href="{{ url('faq') }}">FAQ</a></li>
                                        </ul>
                                    </li>
                                    <li class="{{ Request::is( 'nous-contacter') ? 'active' : '' }}"><a href="{{ url('nous-contacter') }}">Contact</a></li>
                                </ul>
                            </div>

                        </nav><!--end nav-->
                    </div>
                </div>
            </div>
        </div><!--end menu-bar-->
    </header>
</section><!--End Header section-->
