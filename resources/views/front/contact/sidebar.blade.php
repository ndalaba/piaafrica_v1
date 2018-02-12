<div class="col-md-4">
    <div class="sidebar">
        <div class="side-widget">
            <h4 class="inner-heading">Options utilisateur</h4>
            <ul class="list-group">
                <li class="list-group-item">
                    <a href="{{ url('publier-annonce') }}" title="Ajouter une entreprise" class="col">Publier annonces</a>
                </li>
                <li class="list-group-item">
                    <a href="{{ url('mon-compte') }}" title="Consulter mon comte" class="col">Mes Annonces</a>
                </li>
                <li class="list-group-item">
                    <a href="{{ url('mes-messages') }}" class="col" title="Consulter vos messages">Mes Messages</a>
                </li>
                <li class="list-group-item">
                    <a href="{{ url('edit-info') }}" class="col" title="Modifier mes informations">Modifier mes informations</a>
                </li>
            </ul>
        </div>
        <div class="side-widget">
            <h4 class="inner-heading">Statistiques du compte</h4>
            <ul class="list-group">
                <li class="list-group-item">
                    Annonces en ligne: <strong>{{$lignes}}</strong>
                </li>
                <li class="list-group-item">
                    Annonces en attente: <strong>{{$attentes}}</strong>
                </li>
            </ul>
        </div>
    </div>
</div>
