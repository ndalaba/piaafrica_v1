@extends(((Request::ajax()) ? 'admin.layout-ajax' : 'admin.layout'))
@section('title')
    @parent
    | D’un coup d’œil
@stop
@section('content')
    <div id="page-inner" class="home">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-head-line">Tableau de bord</h1>

                <div class="list-group">
                    <h4 class="list-group-item-heading">D’un coup d’œil</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class=" col-md-3 col-sm-3">
                <div class="style-box-one Style-one-clr-one">
                    <a href="{{ url('admin/entreprises/entreprise-action?action=9999&name=&publie=0&une=&section_id=&ville_id=&order=id+DESC&doaction=Filtrer') }}" class="ajax">
                        <span class="fa fa-institution"></span>
                        <h5>({{$entreprisesN}}) Entreprises en attente validation</h5>
                    </a>
                </div>
            </div>
            <div class=" col-md-3 col-sm-3">
                <div class="style-box-one Style-one-clr-one">
                    <a href="{{ url('admin/articles/article-action?action=9999&titre=&publie=0&section_id=&order=id+DESC&doaction=Filtrer') }}" class="ajax">
                        <span class="fa fa-newspaper-o"></span>
                        <h5>({{$newsN}}) articles en attente validation</h5>
                    </a>
                </div>
            </div>
            <div class=" col-md-3 col-sm-3">
                <div class="style-box-one Style-one-clr-one">
                    <a href="{{ url('admin/annonces/annonce-action?action=9999&titre=&publie=0&section_id=&order=id+DESC&doaction=Filtrer') }}" class="ajax">
                        <span class="fa fa-ticket"></span>
                        <h5>({{$annoncesN}}) annonces en attente validation</h5>
                    </a>
                </div>
            </div>
            <div class=" col-md-3 col-sm-3">
                <div class="style-box-one Style-one-clr-one">
                    <a href="{{ url('admin/lettres/lettre-action?action=9999&titre=&publie=0&country_id=&order=id+DESC&doaction=Filtrer') }}" class="ajax">
                        <span class="fa fa-envelope-o"></span>
                        <h5>({{$newslettersN}}) newsletters en attente de publication</h5>
                    </a>
                </div>
            </div>
            <div class=" col-md-3 col-sm-3">
                <div class="style-box-one Style-one-clr-two">
                    <a href="{{ url('admin/entreprises/entreprise-action?action=9999&name=&publie=1&une=&section_id=&ville_id=&order=id+DESC&doaction=Filtrer') }}" class="ajax">
                        <span class="fa fa-institution"></span>
                        <h5>
                            ({{$entreprises}}) Entreprises publiées &nbsp;
                            ({{$vus}}) vues
                        </h5>
                    </a>
                </div>
            </div>
            <div class=" col-md-3 col-sm-3">
                <div class="style-box-one Style-one-clr-two">
                    <a href="{{ url('admin/articles/article-action?action=9999&titre=&publie=1&section_id==&order=id+DESC&doaction=Filtrer') }}" class="ajax">
                        <span class="fa fa-newspaper-o"></span>
                        <h5>({{$news}}) Articles publiés &nbsp;
                            ({{$vues}}) vues
                        </h5>
                    </a>
                </div>
            </div>
            <div class=" col-md-3 col-sm-3">
                <div class="style-box-one Style-one-clr-two">
                    <a href="{{ url('admin/annonces/annonce-action?action=9999&titre=&publie=1&section_id==&order=id+DESC&doaction=Filtrer') }}" class="ajax">
                        <span class="fa fa-ticket"></span>
                        <h5>({{$annonces}}) Annonces publiées &nbsp;
                            ({{$vues_annonces}}) vues
                        </h5>
                    </a>
                </div>
            </div>
            <div class=" col-md-3 col-sm-3">
                <div class="style-box-one Style-one-clr-two">
                    <a href="{{ url('admin/lettres/lettre-action?action=9999&titre=&publie=1&country_id=&order=id+DESC&doaction=Filtrer') }}" class="ajax">
                        <span class="fa fa-envelope-o"></span>
                        <h5>({{ $newsletters }}) newsletters publiées
                            ({{$vues_newsletters}}) vues
                        </h5>
                    </a>
                </div>
            </div>
            <div class=" col-md-3 col-sm-3">
                <div class="style-box-one Style-one-clr-two">
                    <a href="{{ url('admin/candidats') }}" class="ajax">
                        <span class="fa fa-male"></span>
                        <h5>({{ $candidats }}) candidats</h5>
                    </a>
                </div>
            </div>
            <div class=" col-md-3 col-sm-3">
                <div class="style-box-one Style-one-clr-two">
                    <a href="{{ url('admin/contacts') }}" class="ajax">
                        <span class="fa fa-male"></span>
                        <h5>({{ $contacts }}) contacts entreprises</h5>
                    </a>
                </div>
            </div>

            <div class=" col-md-3 col-sm-3">
                <div class="style-box-one Style-one-clr-two">
                    <a href="{{ url('admin/lettres/emails') }}" class="ajax">
                        <span class="fa fa-male"></span>
                        <h5>({{ $emails_actifs.' actifs sur '.$emails }}) inscrits à la newsletter</h5>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
