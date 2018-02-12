@extends(((Request::ajax()) ? 'admin.layout-ajax' : 'admin.layout'))
@section('title')
    @parent
    | Les entreprises sur {{ config('application.name') }}
@stop
@section('content')
    <div id="page-inner" class="entreprises">
        <div class="row">
            <div class="col-md-12">
                <h2 class="page-head-line">Les entreprises sur {{ config('application.name') }} @include('admin.inc.recap_badge')
                    <a href="{{url('admin/entreprises/edit/0/0')}}" class="btn btn-primary" style="margin-left: 20px">Ajouter</a>
                </h2>
            </div>
            <div class="col-md12">
                <form method="get" action="{{url('admin/entreprises/entreprise-action')}}" class="form-inline">

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
                        <input type="text" class="form-control" name="name" placeholder="nom entreprise"/>
                        <select name="publie" class="form-control">
                            <option value="">Etat</option>
                            <option value="1">Publiés</option>
                            <option value="0">Non Publiés</option>
                        </select>
                        <select name="une" class="form-control" >
                            <option value="">Statut</option>
                            <option value="1">A la une</option>
                            <option value="0">Normal</option>
                        </select>
                        <select name="section_id" id="section_id" class="form-control" >
                            <option value="">Section</option>
                            @foreach($sections as $sec)
                                <option value="{{$sec->id}}">{{ $sec->section }}</option>
                            @endforeach
                        </select>
                        <select name="country_id" id="country_id" class="form-control" >
                            <option value="">Pays</option>
                            @foreach($countries as $country)
                                <option value="{{$country->id}}">{{ $country->pays }}</option>
                            @endforeach
                        </select>
                        <select name="ville_id" id="ville_id" class="form-control" >
                            <option value="">Ville</option>
                        </select>
                        <select name="order" id="order" class="form-control" >
                            <option value="id DESC">Trier par</option>
                            <option value="id ASC">Premier d'abord</option>
                            <option value="vu ASC"> Vue croissant</option>
                            <option value="vu DESC"> Vue decroissant</option>
                        </select>
                        <button type="submit" value="Filtrer" name="doaction" id="post-query-submit" class="btn btn-primary">
                            <i class="fa fa-search"></i></button>
                    </div>
                    <div class="table-responsive" style="margin: 10px">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                                <th><input type="checkbox" title="Tout sélectionner" id="select_all"></th>
                                <th>Entreprise</th>
                                <th>Contact</th>
                                <th>Section</th>
                                <th>Pays</th>
                                <th>Position</th>
                                <th>Publie</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($entreprises as $entreprise)
                                <tr>
                                    <th>
                                        <input type="checkbox" name="post[]" value="{{$entreprise->id}}">
                                    </th>
                                    <td>
                                        <strong style="float: left; width: 100%"><a target="_blank" href="{{url('preview/'.$entreprise->id)}}">{{ $entreprise->name }} - ({{$entreprise->vu}} vues)</a></strong>

                                        <div class="row-actions">
                                            <span><a href="{{url('admin/entreprises/edit/'.$entreprise->user_id.'/'.$entreprise->id)}}" title="Modifier cet élément">Modifier</a> | </span>
                                            <span><a class="ajax" style="color: red" class="deleteEntreprise" title="Déplacer cet élément dans la Corbeille" href="{{url('admin/entreprises/delete/'.$entreprise->id)}}">Mettre à la Corbeille</a> </span>
                                        </div>
                                    </td>
                                    @if($entreprise->user)
                                        <td>
                                            <a href="{{url('admin/contacts/edit/'.$entreprise->user->id)}}" class="ajax">{{$entreprise->user->name}}</a>
                                        </td>
                                    @else
                                        <td style="text-align: center"> -</td>
                                    @endif
                                    <td>{{ $entreprise->section->section }}</td>
                                    <td>{{ $entreprise->ville->country->pays }}</td>
                                    <td>{{ $entreprise->position }}</td>
                                    <td>{{ $entreprise->etat }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </form>
                {!! str_replace('/?', '?', $entreprises->render()) !!}
            </div>
        </div>
    </div>

@endsection
