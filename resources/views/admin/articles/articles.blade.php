@extends(((Request::ajax()) ? 'admin.layout-ajax' : 'admin.layout'))
@section('title')
    @parent
    | Les articles sur {{ config('application.name') }}
@stop
@section('content')
    <div id="page-inner" class="articles">
        <div class="row">
            <div class="col-md-12">
                <h2 class="page-head-line">Les articles sur {{ config('application.name') }}
                    <a href="{{url('admin/articles/edit/')}}" class="btn btn-primary" style="margin-left: 20px">Ajouter</a>
                </h2>
            </div>
            <div class="col-md12">
                <form method="get" action="{{url('admin/articles/article-action')}}" class="form-inline">

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
                            <input type="text" class="form-control" name="titre" placeholder="titre article"/>
                            <select name="publie" class="form-control">
                                <option value="">Etat</option>
                                <option value="1">Publiés</option>
                                <option value="0">Non Publiés</option>
                            </select>
                            <select name="une" class="form-control">
                                <option value="">Statut</option>
                                <option value="1">A la une</option>
                                <option value="0">Normal</option>
                            </select>
                            <select name="section_id" id="section_id" class="form-control">
                                <option value="">Selectionner une section</option>
                                @foreach($sections as $sec)
                                    <option value="{{$sec->id}}">{{ $sec->section }}</option>
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
                                <th>Article</th>
                                <th>Section</th>
                                <th>Entreprises</th>
                                <th>Position</th>
                                <th>Publie</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($articles as $article)
                                <tr>
                                    <th>
                                        <input type="checkbox" name="post[]" value="{{$article->id}}">
                                    </th>
                                    <td>
                                        <strong style="float: left; width: 100%"><a  href="{{url('admin/articles/edit/'.$article->id)}}" title="Modifier">{{ $article->titre }} - ({{$article->vue}} vues)</a></strong>

                                        <div class="row-actions">
                                            <span><a href="{{url('admin/articles/edit/'.$article->id)}}" title="Modifier cet élément">Modifier</a> | </span>
                                            <span><a class="ajax" style="color: red" class="submitdelete" title="Déplacer cet élément dans la Corbeille" href="{{url('admin/articles/delete/'.$article->id)}}">Mettre à la Corbeille</a> </span>
                                        </div>
                                    </td>
                                    <td>{{ $article->section->section }}</td>
                                    <td>
                                        @foreach($article->entreprises as $entreprise)
                                            <a class="ajax" href="{{url('admin/entreprises/edit/'.$entreprise->user_id.'/'.$entreprise->id)}}" title="Modifier">{{ $entreprise->name }}</a> |
                                        @endforeach
                                    </td>
                                    <td>{{ $article->position }}</td>                                    
                                    <td>{{ $article->etat }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </form>
                {!! str_replace('/?', '?', $articles->render()) !!}
            </div>
        </div>
    </div>

@endsection
