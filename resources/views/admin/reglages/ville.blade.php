@extends(((Request::ajax()) ? 'admin.layout-ajax' : 'admin.layout'))
@section('title')
    @parent
    | Villes catégories annonces
@stop

@section('content')
    <div id="page-inner" class="villes">
        <div class="row">
            <div class="col-md-12">
                <h2 class="page-head-line"> Villes entreprises</h2>
            </div>
            @if(Session::has('success'))
                <div class="alert alert-success">
                    <p>Ville ajoutée</p>
                </div>
            @endif
            @include('admin.errors')
            <div class="col-md-6">
                <form class="form-inline" method="post" action="{{url('admin/villes/ville-action')}}">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div style="margin: 10px">
                        <div class="form-group">
                            <label>Sélectionnez l’action groupée</label>
                            <select name="action" class="form-control">
                                <option value="-1" selected="selected">Actions groupées</option>
                                <option value="trash">Déplacer dans la Corbeille</option>
                            </select>
                            <input type="submit" name="doaction"  id="doaction" class="btn btn-primary action" value="Appliquer">
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                                <th>Ville</th>
                                <th>Pays</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($villes as $cat)
                                <tr>
                                    <td>
                                        <strong>
                                            <a  style="float: left; width: 100%" class="ajax" href="{{ url('admin/villes/ville/'.$cat->id) }}" title="Modifier">{{$cat->ville}}</a>
                                        </strong>

                                        <div class="row-actions">
                                            <span class="edit"><a class="ajax" href="{{ url('admin/villes/ville/'.$cat->id) }}">Modifier</a></span>
                                            |
                                            <span class="delete"><a class="ajax" href="{{ url('admin/villes/ville-delete/'.$cat->id) }}">Supprimer </a>  </span>
                                        </div>
                                    </td>
                                    <td>{{ $cat->country->pays }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                @if(is_null($ville->id))
                    <h3>Ajouter une nouvelle ville</h3>
                @else
                    <h3>Modifier la ville <strong>{{$ville->ville}}</strong></h3>
                @endif
                @if(is_null($ville->id))
                    <form method="post" action="{{url('admin/villes/create-ville')}}" class="form">
                @else
                    <form  method="post" action="{{url('admin/villes/update-ville')}}" class="form">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="id" value="{{$ville->id}}">
                @endif
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label for="country_id">Pays</label>
                            <select name="country_id" id="country_id" class="form-control" required>
                                <option value="57">Pays</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country->id }}" @if($country->id==$ville->country_id) selected @endif>{{ $country->pays }}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="ville">Ville</label>
                            <input class="form-control" name="ville" id="ville" type="text" value="{{$ville->ville}}" autocomplete="off" required="true">
                        </div>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </form>
            </div>
        </div>
    </div>
@endsection
