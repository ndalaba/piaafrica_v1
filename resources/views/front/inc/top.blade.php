<div class="header-top-bar">
    <div class="container">
    @include('front.inc.login')

    <!-- HEADER-LOG0 -->
        <div class="header-logo text-center">
            <span><a href="{{ url('/') }}" title="{{config('application.name')}}"><i class="fa fa-paypal"></i>IA<i class="fa fa-adn"></i>frica</a></span>
        </div>
        <!-- END HEADER LOGO -->

        <!-- HEADER-SOCIAL -->
        <div class="header-social">
            <a href="#">
                <span><i class="fa fa-share-alt"></i></span>
                <i class="fa fa-chevron-down social-arrow"></i>
            </a>

            <ul class="list-inline">
                <li class="active">
                    <a href="https://www.facebook.com/PIA-Africa-1238895382848814/"><i class="fa fa-facebook-square"></i></a>
                </li>
                <li>
                    <a href="https://plus.google.com/109675597617359280146/"><i class="fa fa-google-plus-square"></i></a>
                </li>
                <li><a href="https://twitter.com/pia_africa"><i class="fa fa-twitter-square"></i></a></li>
                <li><a href="#"><i class="fa fa-linkedin-square"></i></a></li>
            </ul>
        </div>
        @if(!Auth::user())
            <div class="header-call-to-action">
                <a href="{{ url('publier-entreprise') }}" title="Ajouter une entreprise à l'annuaire" class="btn btn-default"><i class="fa fa-plus"></i> Inscrire mon entreprise</a>
            </div>
        @elseif(Auth::user()->droit < config('application.contact'))
            <div class="header-call-to-action">
                <a href="{{ url('candidat/mon-compte') }}" class="btn btn-default" title="Accéder à votre compte {{config('application.name')}}"><i class="fa fa-plus"></i> Mon compte</a>
            </div>
        @else
            <div class="header-call-to-action">
                <a href="{{ url('mon-compte') }}" class="btn btn-default" title="Accéder à votre compte {{config('application.name')}}"><i class="fa fa-plus"></i> Mon compte</a>
            </div>
        @endif

    </div>
    <!-- END .CONTAINER -->
</div>
