@extends(((Request::ajax()) ? 'admin.layout-ajax' : 'admin.layout'))
@section('title')
    @parent
    | Les lettres sur {{ config('application.name') }}
@stop
@section('content')
    <div id="page-inner" class="lettres">
        <div class="row">
            <div class="col-md-12">
                <h2 class="page-head-line">Les lettres sur {{ config('application.name') }}
                    <a href="{{url('admin/lettres/edit/')}}" class="btn btn-primary" style="margin-left: 20px">Ajouter</a>
                </h2>
            </div>
            <div class="col-md12">
                <form method="get" action="{{url('admin/lettres/lettre-action')}}" class="form-inline">

                    <div style="margin: 10px">
                        <div class="form-group">
                            <!--<label>Sélectionnez l’action groupée</label>-->
                            <select name="action" class="form-control">
                                <option value="9999">Actions groupées</option>
                                <option value="-1">Supprimer</option>
                                <option value="1">Publier</option>
                            </select>
                            <input type="number" value="180" name="nombre" id="nombre"/>
                            <input type="submit" name="doaction" id="doaction" class="btn btn-primary action" value="Appliquer">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="titre" placeholder="titre lettre"/>
                            <select name="publie" class="form-control">
                                <option value="">Etat</option>
                                <option value="1">Publiés</option>
                                <option value="0">Non Publiés</option>
                            </select>
                            <select name="country_id" id="country_id" class="form-control">
                                <option value="">Selectionner un pays</option>
                                @foreach($countries as $sec)
                                    <option value="{{$sec->slug}}">{{ $sec->pays }}</option>
                                @endforeach
                            </select>
                            <select name="order" id="order" class="form-control">
                                <option value="id DESC">Trier par</option>
                                <option value="id ASC">Premier d'abord</option>
                                <option value="vue ASC"> Vue croissant</option>
                                <option value="vue DESC"> Vue decroissant</option>
                            </select>
                            <input type="submit" name="doaction" id="post-query-submit" class="btn btn-primary" value="Filtrer">
                        </div>
                    </div>
                    <div class="table-responsive" style="margin: 10px">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                                <th><input type="checkbox" title="Tout sélectionner" id="select_all"></th>
                                <th>Dernière activité</th>
                                <th>Lettre</th>
                                <th>Statut</th>
                                <th>Pays</th>
                                <th>Publie</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($lettres as $lettre)
                                <tr>
                                    <th>
                                        <input type="checkbox" name="post[]" value="{{$lettre->id}}">
                                    </th>
                                    <td style="font-weight: bold">{{ \App\Http\Models\Help::timestampToDate($lettre->image,true) }}</td>
                                    <td>
                                        <strong style="float: left; width: 100%"><a href="{{url('admin/lettres/edit/'.$lettre->id)}}" title="Modifier">{{ $lettre->titre }} - ({{$lettre->vue}} vues sur {{$lettre->lastuser}})</a></strong>

                                        <div class="row-actions">
                                            <span><a href="{{url('admin/lettres/edit/'.$lettre->id)}}" title="Modifier cet élément">Modifier</a> | </span>
                                            <span><a class="ajax" style="color: red" class="submitdelete" title="Déplacer cet élément dans la Corbeille" href="{{url('admin/lettres/delete/'.$lettre->id)}}">Mettre à la Corbeille</a> </span>
                                        </div>
                                    </td>
                                    <td>{!! $lettre->statut !!}</td>
                                    <td>
                                        @if($lettre->country)
                                            {{ $lettre->country->pays }}
                                        @else
                                            {{var_dump($lettre->country)}}
                                        @endif
                                    </td>
                                    <td>{{ $lettre->etat }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </form>
                {!! str_replace('/?', '?', $lettres->render()) !!}
            </div>
        </div>
    </div>

@endsection
