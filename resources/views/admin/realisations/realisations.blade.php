@extends(((Request::ajax()) ? 'admin.layout-ajax' : 'admin.layout'))
@section('title')
    @parent
    | Les realisations sur {{ config('application.name') }}
@stop
@section('content')
    <div id="page-inner" class="realisations">
        <div class="row">
            <div class="col-md-12">
                <h2 class="page-head-line">Les realisations sur {{ config('application.name') }}
                    <a href="{{url('admin/realisations/edit/')}}" class="btn btn-primary" style="margin-left: 20px">Ajouter</a>
                </h2>
            </div>
            <div class="col-md12">
                <form method="get" action="{{url('admin/realisations/realisation-action')}}" class="form-inline">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div style="margin: 10px">
                        <div class="form-group">
                            <label>Sélectionnez l’action groupée</label>
                            <select name="action" class="form-control">
                                <option value="9999">Actions groupées</option>
                                <option value="-1">Supprimer</option>
                                <option value="1">Publier</option>
                                <option value="0">Dépublier</option>
                            </select>
                            <input type="submit" name="doaction" id="doaction" class="btn btn-primary action" value="Appliquer">
                        </div>
                        <div class="form-group">
                            <select name="gservice" class="form-control">
                                <option value="">Service</option>
                              @foreach($services as $s)
                                <option value="{{ $s->id }}">{{ $s->service }}</option>
                                @endforeach
                            </select>
                            <input type="submit" name="doaction" id="post-query-submit" class="btn btn-primary" value="Filtrer">
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                                <th><input type="checkbox" title="Tout sélectionner" id="select_all"></th>
                                <th>Réalisation</th>
                                <th>Service</th>
                                <th>URL</th>
                                <th>Publie</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($realisations as $realisation)
                                <tr>
                                    <th>
                                        <input type="checkbox" name="post[]" value="{{$realisation->id}}">
                                    </th>
                                    <td>
                                        <strong style="float: left; width: 100%"><a  href="{{url('admin/realisations/edit/'.$realisation->id)}}" title="Modifier">{{ $realisation->realisation }}</a></strong>

                                        <div class="row-actions">
                                            <span><a href="{{url('admin/realisations/edit/'.$realisation->id)}}" title="Modifier cet élément">Modifier</a> | </span>
                                            <span><a class="ajax" style="color: red" class="submitdelete" title="Déplacer cet élément dans la Corbeille" href="{{url('admin/realisations/delete/'.$realisation->id)}}">Mettre à la Corbeille</a> </span>
                                        </div>
                                    </td>
                                    <td></td>
                                    <td><a href="{{$realisation->url}}" target="_blank">{{ $realisation->url }}</a></td>
                                    <td>{{ $realisation->etat }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </form>
                {!! $realisations->render() !!}
            </div>
        </div>
    </div>

@endsection