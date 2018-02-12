@extends(((Request::ajax()) ? 'admin.layout-ajax' : 'admin.layout'))
@section('title')
    @parent
    | Les offres d'emploi sur {{ config('application.name') }}
@stop
@section('content')
    <div id="page-inner" class="annonces">
        <div class="row">
            <div class="col-md-12">
                <h2 class="page-head-line">Les annonces sur {{ config('application.name') }} @include('admin.inc.recap_badge')
                    <a href="{{url('admin/annonces/edit/0')}}" class="btn btn-primary" style="margin-left: 20px">Ajouter</a>
                </h2>
            </div>
            <div class="col-md12">
                <form method="get" action="{{url('admin/annonces/annonce-action')}}" class="form-inline">

                    <div style="margin: 10px">
                        <div class="form-group">
                            <!--<label>Sélectionnez l’action groupée</label>-->
                            <select name="action" class="form-control">
                                <option value="9999">Actions groupées</option>
                                <option value="-1">Supprimer</option>
                                <option value="1">Publier</option>
                                <option value="0">Dépublier</option>
                                <option value="2">A la une</option>
                                <option value="-2">Normale</option>
                            </select>
                            <input type="submit" name="doaction" id="doaction" class="btn btn-primary action" value="Appliquer">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="titre" placeholder="titre annonce" />
                            <select name="publie" class="form-control" >
                                <option value="">Etat</option>
                                <option value="1">Publiés</option>
                                <option value="0">Non Publiés</option>
                            </select>
                            <select name="une" class="form-control" >
                                <option value="">Statut</option>
                                <option value="1">A la une</option>
                                <option value="0">Normal</option>
                            </select>
                            <select name="entreprise_id" id="entreprise_id" class="form-control" >
                                <option value="Entreprise">Entreprise</option>
                                @foreach($entreprises as $entreprise)
                                    <option value="{{$entreprise->id}}">{{ str_limit($entreprise->name,25) }}</option>
                                @endforeach
                            </select>
                            <select name="section_id" id="section_id" class="form-control" >
                                <option value="">Section</option>
                                @foreach($sections as $sec)
                                    <option value="{{$sec->id}}">{{ str_limit($sec->section,25) }}</option>
                                @endforeach
                            </select>
                            <select name="country_id" id="country_id" class="form-control" >
                                <option value="">Pays</option>
                                @foreach($countries as $country)
                                    <option value="{{$country->id}}">{{ str_limit($country->pays,15) }}</option>
                                @endforeach
                            </select>
                            <select name="ville_id" id="ville_id" class="form-control">
                                <option value="">Ville</option>
                            </select>
                            <select name="order" id="order" class="form-control" >
                                <option value="id DESC">Trier par</option>
                                <option value="id ASC">Premier d'abord</option>
                                <option value="vu ASC"> Vue croissant</option>
                                <option value="vu DESC"> Vue decroissant</option>
                            </select>
                            <button type="submit" name="doaction" id="post-query-submit" class="btn btn-primary" value="Filtrer">
                                <i class="fa fa-search"></i></button>
                        </div>
                    </div>
                    <div class="table-responsive" style="margin: 10px">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                                <th><input type="checkbox" title="Tout sélectionner" id="select_all"></th>
                                <th>Annonce</th>
                                <th>Date</th>
                                <th>Date d'expiration</th>
                                <th>Entreprise</th>
                                <th>Pays</th>
                                <th>Publie</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($annonces as $annonce)
                                <tr>
                                    <th>
                                        <input type="checkbox" name="post[]" value="{{$annonce->id}}">
                                    </th>
                                    <td>
                                        <strong style="float: left; width: 100%"><a target="_blank" href="{{$annonce->link}}" title="{{$annonce->titre}}">{{ str_limit($annonce->titre,50 )}} - ({{$annonce->vu}} vues)</a></strong>

                                        <div class="row-actions">
                                            <span><a href="{{url('admin/annonces/edit/'.$annonce->id)}}" title="Modifier cet élément">Modifier</a> | </span>
                                            <span><a class="ajax" style="color: red" class="deleteAnnonce" title="Déplacer cet élément dans la Corbeille" href="{{url('admin/annonces/delete/'.$annonce->id)}}">Mettre à la Corbeille</a> </span>
                                        </div>
                                    </td>
                                    <td>{{ \App\Http\Models\Help::timestampToDate($annonce->created_at,true) }}</td>
                                    <td>{{ \App\Http\Models\Help::timestampToDate($annonce->fin) }}</td>
                                    @if($annonce->entreprise)
                                        <td>
                                            <a href="{{$annonce->entreprise->link}}" target="_blank">{{$annonce->entreprise->name}}</a>
                                        </td>
                                    @else
                                        <td style="text-align: center"> -</td>
                                    @endif

                                    <td>{{ $annonce->ville->country->pays }}</td>
                                    <td>{{ $annonce->etat }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </form>
                {!! str_replace('/?', '?', $annonces->render()) !!}
            </div>
        </div>
    </div>

@endsection
