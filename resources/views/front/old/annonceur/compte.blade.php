@extends('front.layout')
@section('title') Compte maakiti de {{ \Auth::user()->name }} - @parent @stop
@section('description')Envie de vendre, louer un bien personnel ? Déposer votre annonce gratuitement sur maakiti.com, le plus grand site de petites annonces dans votre région ! - @parent @stop

@section('content')

    <section id="page-head">
        <div class="container">
            <div class="row col-md-12">
                <div class="page-heading">
                    <h1>Bienvenu {{ \Auth::user()->name }}.</h1>

                    <p>Ci-dessous vous trouverez une liste de toutes vos annonces classées.
                       Cochez les annonces pour effectuer une opération(publier,dépublier,supprimer) dessus.
                       Si vous avez des questions, s'il vous plaît contactez l'administrateur du site.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section id="detail">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <!--  <div class="main-heading text-center">
                          <h2>DERNIÈRES ANNONCES</h2>
                      </div>-->
                    <div class="tabbable-panel">
                        <div class="col-md12">
                            <form method="post" action="{{url('mon-compte')}}" class="form-inline">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <div style="margin: 10px">
                                    <div class="form-group">
                                        <label>Sélectionnez l’action groupée</label>
                                        <select name="action" class="form-control">
                                            <option value="">Actions groupées</option>
                                            <option value="-1">Supprimer</option>
                                            <option value="0">Dépublier</option>
                                        </select>
                                        <input type="submit" name="doaction" id="doaction" class="btn btn-primary action" value="Appliquer">
                                    </div>
                                    <div class="form-group">
                                        <select name="publie" class="form-control">
                                            <option value="">Etat</option>
                                            <option value="1">Publiés</option>
                                            <option value="0">Non Publiés</option>
                                        </select>
                                        <input type="submit" name="doaction" id="post-query-submit" class="btn btn-primary" value="Filtrer">
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th><input type="checkbox" title="Tout sélectionner" id="select_all"></th>
                                            <th>Titre</th>
                                            <th>Type</th>
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
                                                    <strong>
                                                        <a href="{{ url('annonce/'.$annonce->typeannonce.'/'.$annonce->categorie->slug.'/'.$annonce->slug.'?a='.$annonce->id) }}" title="{{ $annonce->titre }}">{{ $annonce->titre }}</a>
                                                    </strong>

                                                    <div class="row-actions">
                                                        <span><a class="ajax" href="{{url('publier-annonce/'.$annonce->id)}}" title="Modifier cet élément">Modifier</a> | </span>
                                                        <span><a class="ajax" style="color: red" class="submitdelete" title="Déplacer cet élément dans la Corbeille" href="{{url('annonces/delete/'.$annonce->id)}}">Mettre à la Corbeille</a> </span>
                                                    </div>
                                                </td>
                                                <td>{{ $annonce->typeannonce }}</td>
                                                <td>{{ $annonce->etat }}</td>
                                            </tr>
                                        @endforeach
                                        @if(count($annonces)<=0)
                                            <tr>
                                                <td colspan="4" style="text-align: center">Aucune annonce liée à ce compte</td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @include('front.annonceur.sidebar')
            </div>
        </div>
    </section>
@stop
