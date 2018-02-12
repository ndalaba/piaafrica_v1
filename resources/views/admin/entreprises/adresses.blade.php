@extends(((Request::ajax()) ? 'admin.layout-ajax' : 'admin.layout'))
@section('title')
    @parent
    | Adresses - {{$entreprise->name}}
@stop

@section('content')
    <div id="page-inner" class="adresses">
        <div class="row">
            <div class="col-md-12">
                <h2 class="page-head-line"> Adresses <a href="{{ url('admin/entreprises/edit/'.$entreprise->user_id.'/'.$entreprise->id) }}" class="btn btn-primary btn-sm ajax"><i class="fa fa-backward"></i>  {{ $entreprise->name }}</a></h2>
            </div>
            @if(Session::has('success'))
                <div class="alert alert-success">
                    <p>Adresse ajouté</p>
                </div>
            @endif
            @include('admin.errors')
            <div class="col-md-6">
                <form class="form-inline" method="get" action="{{url('admin/entreprises-detail/adresse-action')}}">
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
                                <th>Adresse</th>
                                <th>Téléphone</th>
                                <th>Ville</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($adresses as $cat)
                                <tr>
                                    <td>
                                        <strong>
                                            <a  style="float: left; width: 100%" class="ajax" href="{{ url('admin/entreprise-detail/adresse/'.$entreprise->id.'/'.$cat->id) }}" title="Modifier">{{$cat->adresse}}</a>
                                        </strong>

                                        <div class="row-actions">
                                            <span class="edit"><a class="ajax" href="{{ url('admin/entreprise-detail/adresse/'.$entreprise->id.'/'.$cat->id) }}">Modifier</a></span>
                                            |
                                            <span class="delete"><a class="ajax" href="{{ url('admin/entreprise-detail/adresse-delete/'.$entreprise->id.'/'.$cat->id) }}">Supprimer </a>  </span>
                                        </div>
                                    </td>
                                    <td>{{$cat->phone}}</td>
                                    <td>{{$cat->ville->ville}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                @if(is_null($adresse->id))
                    <h3>Ajouter un nouveau adresse</h3>
                @else
                    <h3>Modifier le adresse <strong>{{$adresse->adresse}}</strong></h3>
                @endif
                @if(is_null($adresse->id))
                    <form method="post" action="{{url('admin/entreprises-detail/create-adresse')}}" class="form">
                        @else
                            <form  method="post" action="{{url('admin/entreprise-detail/update-adresse')}}" class="form">
                                <input type="hidden" name="_method" value="PUT">
                                <input type="hidden" name="id" value="{{$adresse->id}}">
                                @endif
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="entreprise_id" value="{{ $entreprise->id }}">
                                <div class="form-group">
                                    <label for="adresse">Téléphone</label>
                                    <input class="form-control" name="phone" id="phone" type="text" value="{{$adresse->phone}}" autocomplete="off" required="true">
                                </div>
                                <div class="form-group">
                                    <label for="pays">Ville</label>
                                    <select name="ville_id" id="ville_id" required class="form-control">
                                        <option value=""></option>
                                        @foreach($villes as $ville)
                                            <option value="{{$ville->id}}" @if($ville->id==$adresse->ville_id) selected @endif>{{ $ville->ville }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="description">Adresse</label>
                                    <textarea name="adresse" id="adresse"  class="form-control">{{$adresse->adresse}}</textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Enregistrer</button>
                            </form>
                  </div>
        </div>
    </div>
@endsection
