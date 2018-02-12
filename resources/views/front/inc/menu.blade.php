<nav>
    <button><i class="fa fa-bars"></i></button>
    <ul class="primary-nav list-unstyled">
        <li class="{{ Request::is( '/') ? 'bg-color' : '' }}"><a href="{{ url('/') }}" title="Page d'accueil {{config('application.name')}}">Accueil</a></li>
        <li class="{{ starts_with('annuaire',Request::segment(1) )? 'bg-color' : '' }}"><a href="{{ url('annuaire') }}" title="Annuaire entreprises africaines">Annuaire </a></li>
        <li class="{{ starts_with('emploi',Request::segment(1) )? 'bg-color' : '' }}"><a href="{{ url('emploi') }}" title="offres d'emploi en  afrique">Offres d'emploi </a></li>
        @if(Auth::user() && Auth::user()->droit >= config('application.annonceur'))
            <li class="{{ starts_with('cvtheques',Request::segment(1) )? 'bg-color' : '' }}"><a href="{{ url('cvtheques') }}" title="Notre collections de CV">CVThèques </a></li>
        @endif
        <li class="{{ starts_with('actualites',Request::segment(1) )? 'bg-color' : '' }}"><a href="{{ url('actualites') }}" title="Actualités entreprises africaines">Actualités</a></li>
        <li class="{{ Request::is( 'qui-sommes-nous') ? 'bg-color' : '' }}"><a href="{{ url('qui-sommes-nous') }}" title="A propos de {{ config('application.name')}}">Qui sommes nous?</a></li>
        <li class="{{ Request::is( 'nous-contacter') ? 'bg-color' : '' }}"><a href="{{ url('nous-contacter') }}" title="Contacter {{config('application.name')}}">Contact</a></li>
    </ul>
</nav>