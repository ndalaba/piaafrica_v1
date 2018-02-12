<nav>
    <button><i class="fa fa-bars"></i></button>
    <ul class="primary-nav list-unstyled">
        <li><a href="{{ url('candidat/mon-compte') }}">Mon compte</a></li>
        @if(Auth::user()->ville_id)
            <li><a href="{{ url('candidat/edit-info') }}">Modifier mes informations</a></li>
        @else
            <li><a href="{{ url('candidat/edit-info') }}">Completer mes informations</a></li>
        @endif
        <li><a href="{{ url('candidat/details') }}">Détails compte</a></li>
        <li><a href="{{ url('candidat/cv') }}">Mon VC</a></li>
        <li><a href="{{ url('emploi') }}">Les offres d'emploi</a></li>
    </ul>
</nav>