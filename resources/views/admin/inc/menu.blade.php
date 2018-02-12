<nav class="navbar-default navbar-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">
            <li>
                <div class="user-img-div">
                    <img src="{{ asset('/admin/img/f5adf3427f58c4043955a9e6307c1fe2.png') }}" class="img-circle"/>
                </div>
            </li>
            <li style="text-align:center">
                <a class="ajax" href="{{url('admin/users/edit/'.Auth::user()->id)}}" title="Profil">
                    <strong> {{ Auth::user()->name }} </strong></a>
            </li>
            <li>
                <a id="home" class="active-menu ajax" title="Tableau de bord" href="{{ url('admin/index') }}"><i class="fa fa-dashboard "></i>Tableau de bord</a>
            </li>
            <li>
                <a id="entreprises" href="#"><i class="fa fa-institution"></i> Entreprises
                    <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a class="ajax" href="{{ url('admin/entreprises') }}" title="les entreprises">
                            <i class="fa fa-share-alt-square "></i> Entreprises</a>
                    </li>
                    <li>
                        <a class="ajax" href="{{url('admin/entreprises/edit/0/0')}}" title="Ajouter une entreprises">
                            <i class="fa fa-pencil "></i> Ajouter</a>
                    </li>
                    <li>
                        <a class="ajax" href="{{ url('admin/contacts') }}" title="les contacts">
                            <i class="fa fa-users "></i> Contacts </a>
                    </li>
                </ul>
            </li>
            <li>
                <a id="annonces" href="#"><i class="fa fa-tags"></i> Annonces <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a class="ajax" href="{{ url('admin/annonces') }}" title="les annonces d'emploi">
                            <i class="fa fa-share-alt-square "></i> Annonces</a>
                    </li>
                    <li>
                        <a class="ajax" href="{{ url('admin/annonces/edit') }}" title="Ajouter une annonce">
                            <i class="fa fa-pencil "></i> Ajouter</a>
                    </li>
                    @if(Auth::user()->droit >= config('application.administrateur'))
                        <li>
                            <a class="ajax" href="{{ url('admin/candidats') }}" title="les contacts">
                                <i class="fa fa-users "></i> Candidats </a>
                        </li>
                    @endif
                </ul>
            </li>
            <li>
                <a id="articles" href="#"><i class="fa fa-newspaper-o"></i> Article <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a class="ajax" href="{{ url('admin/articles') }}" title="les articles">
                            <i class="fa fa-hacker-news "></i> Articles</a>
                    </li>
                    <li>
                        <a class="ajax" href="{{ url('admin/articles/edit') }}" title="Ajouter un article">
                            <i class="fa fa-pencil "></i> Ajouter</a>
                    </li>
                </ul>
            </li>
            @if(Auth::user()->droit >= config('application.administrateur'))
                <li>
                    <a id="lettres" href="#"><i class="fa fa-envelope"></i> Newsletters
                        <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a class="ajax" href="{{ url('admin/lettres') }}" title="les newsletters">
                                <i class="fa fa-envelope-o "></i> Newsletters</a>
                        </li>
                        <li>
                            <a class="ajax" href="{{ url('admin/lettres/edit') }}" title="Ajouter une newsletter">
                                <i class="fa fa-pencil "></i> Ajouter</a>
                        </li>
                        <li>
                            <a class="ajax" href="{{ url('admin/lettres/emails') }}" title="Ajouter une newsletter">
                                <i class="fa fa-envelope-square "></i> Emails</a>
                        </li>
                    </ul>
                </li>
                @endif
                        <!--  <li>
                <a id="realisations" href="#"><i class="fa fa-puzzle-piece"></i> {{config('application.name')}} <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a class="ajax" href="{{ url('admin/services') }}" title="les services"> <i class="fa fa-tags "></i> Services</a>
                    </li>
                    <li>
                        <a class="ajax" href="{{ url('admin/realisations') }}" title="les realisations"> <i class="fa fa-share-alt-square "></i> Réalisations</a>
                    </li>
                </ul>
            </li>-->
                <li>
                    <a id="sections" href="#"><i class="fa fa-tags"></i> Réglages <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a class="ajax" href="{{ url('admin/sections/sections') }}" title="Sections catégories d'entreprise">
                                <i class="fa fa-list "></i> Sections</a>
                        </li>
                        <li>
                            <a class="ajax" href="{{ url('admin/countrys/countrys') }}" title="Pays entreprises">
                                <i class="fa fa-list "></i> Pays</a>
                        </li>
                        <li>
                            <a class="ajax" href="{{ url('admin/villes/villes') }}" title="Villes des entreprises">
                                <i class="fa fa-list "></i> Villes</a>
                        </li>
                    </ul>
                </li>
                @if(Auth::user()->droit >= config('application.administrateur'))
                    <li>
                        <a id="pub" href="#"><i class="fa fa-ticket"></i> Publicité <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="ajax" href="{{ url('admin/pubs/pubs') }}" title="Les publicités sur maakiti">
                                    <i class="fa fa-list"></i> Publicités</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a id="users" href="#"><i class="fa fa-users "></i> Utilisateurs <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="ajax" href="{{ url('admin/users') }}" title="Utilisateurs">
                                    <i class="fa fa-list "></i> Utilisateurs</a>
                            </li>
                            <li>
                                <a class="ajax" href="{{ url('admin/users/edit') }}" title="Ajouter un utilisateur">
                                    <i class="fa fa-pencil "></i> Ajouter</a>
                            </li>
                            <li>
                                <a class="ajax" href="{{url('admin/users/edit/'.Auth::user()->id)}}" title="mon profils">
                                    <i class="fa fa-pencil "></i> Profil</a>
                            </li>
                        </ul>
                    </li>
                @endif
        </ul>
    </div>
</nav>
