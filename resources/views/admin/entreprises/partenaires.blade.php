@extends(((Request::ajax()) ? 'admin.layout-ajax' : 'admin.layout'))
@section('title')
    @parent
    | Partenaires - {{$entreprise->name}}
@stop

@section('content')
    <div id="page-inner" class="partenaires">
        <div class="row">
            <div class="col-md-12">
                <h2 class="page-head-line"> Partenaires <a href="{{ url('admin/entreprises/edit/'.$entreprise->user_id.'/'.$entreprise->id) }}" class="btn btn-primary btn-sm ajax"><i class="fa fa-backward"></i>  {{ $entreprise->name }}</a></h2>
            </div>
            @if(Session::has('success'))
                <div class="alert alert-success">
                    <p>Partenaire ajouté</p>
                </div>
            @endif
            @include('admin.errors')
            <div class="col-md-6">
                <form class="form-inline" method="get" action="{{url('admin/entreprises-detail/partenaire-action')}}">
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
                                <th>Partenaire</th>
                                <th>Image</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($partenaires as $cat)
                                <tr>
                                    <td>
                                        <strong>
                                            <a  style="float: left; width: 100%" class="ajax" href="{{ url('admin/entreprise-detail/partenaire/'.$entreprise->id.'/'.$cat->id) }}" title="Modifier">{{$cat->partenaire}}</a>
                                        </strong>

                                        <div class="row-actions">
                                            <span class="edit"><a class="ajax" href="{{ url('admin/entreprise-detail/partenaire/'.$entreprise->id.'/'.$cat->id) }}">Modifier</a></span>
                                            |
                                            <span class="delete"><a class="ajax" href="{{ url('admin/entreprise-detail/partenaire-delete/'.$entreprise->id.'/'.$cat->id) }}">Supprimer </a>  </span>
                                        </div>
                                    </td>
                                    <td style="width: 40%"><img src="{{asset('uploads/entreprises/partenaires/'.$cat->logo)}}" alt="{{$cat->partenaire}}" style="width: 100%"/></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                @if(is_null($partenaire->id))
                    <h3>Ajouter un nouveau partenaire</h3>
                @else
                    <h3>Modifier le partenaire <strong>{{$partenaire->partenaire}}</strong></h3>
                @endif
                @if(is_null($partenaire->id))
                    <form method="post" action="{{url('admin/entreprises-detail/create-partenaire')}}" class="form" enctype="multipart/form-data">
                        @else
                            <form  method="post" action="{{url('admin/entreprise-detail/update-partenaire')}}" class="form" enctype="multipart/form-data">
                                <input type="hidden" name="_method" value="PUT">
                                <input type="hidden" name="id" value="{{$partenaire->id}}">
                                @endif
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="entreprise_id" value="{{ $entreprise->id }}">
                                <div class="form-group">
                                    <label for="partenaire">Partenaire</label>
                                    <input class="form-control" name="partenaire" id="partenaire" type="text" value="{{$partenaire->partenaire}}" autocomplete="off" required="true">
                                </div>
                                <div class="form-group">
                                    <label for="pays">Image</label>
                                    <input type="file" name="fichier" id="fichier"/>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="description"  class="form-control">{{$partenaire->description}}</textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Enregistrer</button>
                            </form>
            </div>
        </div>
    </div>
@endsection
