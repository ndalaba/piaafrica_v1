@extends(((Request::ajax()) ? 'admin.layout-ajax' : 'admin.layout'))
@section('title')
    @parent
    | Pays entreprises
@stop

@section('content')
    <div id="page-inner" class="pays">
        <div class="row">
            <div class="col-md-12">
                <h2 class="page-head-line"> Pays entreprises</h2>
            </div>
            @if(Session::has('success'))
                <div class="alert alert-success">
                    <p>Pays ajouté</p>
                </div>
            @endif
            @include('admin.errors')
            <div class="col-md-6">
                <form class="form-inline" method="post" action="{{url('admin/countrys/country-action')}}">
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
                                <th>Pays</th>
                                <th>Code</th>
                                <th>Carte</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($countrys as $cat)
                                <tr>
                                    <td>
                                        <strong>
                                            <a  style="float: left; width: 100%" class="ajax" href="{{ url('admin/countrys/country/'.$cat->id) }}" title="Modifier">{{$cat->pays}}</a>
                                        </strong>

                                        <div class="row-actions">
                                            <span class="edit"><a class="ajax" href="{{ url('admin/countrys/country/'.$cat->id) }}">Modifier</a></span>
                                            |
                                            <span class="delete"><a class="ajax" href="{{ url('admin/countrys/country-delete/'.$cat->id) }}">Supprimer </a>  </span>
                                        </div>
                                    </td>
                                    <td>  {{$cat->code}}</td>
                                    <td>@if($cat->carte)<img src="{{ asset('uploads/pays/'.$cat->carte) }}" alt=" {{$cat->pays}}" style="width: 100px">@endif</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                @if(is_null($country->id))
                    <h3>Ajouter un nouveau pays</h3>
                @else
                    <h3>Modifier la pays <strong>{{$country->pays}}</strong></h3>
                @endif
                @if(is_null($country->id))
                    <form method="post" action="{{url('admin/countrys/create-country')}}" class="form" enctype="multipart/form-data">
                @else
                    <form  method="post" action="{{url('admin/countrys/update-country')}}" class="form" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="id" value="{{$country->id}}">
                @endif
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label for="pays">Pays</label>
                            <input class="form-control" name="pays" id="pays" type="text" value="{{$country->pays}}" autocomplete="off" required="true">
                        </div>
                        <div class="form-group">
                            <label for="code">Code</label>
                            <input class="form-control" name="code" id="code" type="text" value="{{$country->code}}" autocomplete="off" required="true">
                        </div>
                        <div class="form-group">
                            <label for="fichier">Carte</label>
                            <input type="file" name="fichier" id="fichier">
                        </div>

                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </form>
            </div>
        </div>
    </div>
@endsection
