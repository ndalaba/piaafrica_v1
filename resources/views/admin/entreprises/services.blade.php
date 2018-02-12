@extends(((Request::ajax()) ? 'admin.layout-ajax' : 'admin.layout'))
@section('title')
    @parent
    | Services - {{$entreprise->name}}
@stop

@section('content')
    <div id="page-inner" class="services">
        <div class="row">
            <div class="col-md-12">
                <h2 class="page-head-line"> Services <a href="{{ url('admin/entreprises/edit/'.$entreprise->user_id.'/'.$entreprise->id) }}" class="btn btn-primary btn-sm ajax"><i class="fa fa-backward"></i>  {{ $entreprise->name }}</a></h2>
            </div>
            @if(Session::has('success'))
                <div class="alert alert-success">
                    <p>Service ajouté</p>
                </div>
            @endif
            @include('admin.errors')
            <div class="col-md-6">
                <form class="form-inline" method="get" action="{{url('admin/entreprises-detail/service-action')}}">
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
                                <th>Service</th>
                                <th>Description</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($services as $cat)
                                <tr>
                                    <td>
                                        <strong>
                                            <a  style="float: left; width: 100%" class="ajax" href="{{ url('admin/entreprise-detail/service/'.$entreprise->id.'/'.$cat->id) }}" title="Modifier">{{$cat->service}}</a>
                                        </strong>

                                        <div class="row-actions">
                                            <span class="edit"><a class="ajax" href="{{ url('admin/entreprise-detail/service/'.$entreprise->id.'/'.$cat->id) }}">Modifier</a></span>
                                            |
                                            <span class="delete"><a class="ajax" href="{{ url('admin/entreprise-detail/service-delete/'.$entreprise->id.'/'.$cat->id) }}">Supprimer </a>  </span>
                                        </div>
                                    </td>
                                    <td>{{$cat->description}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                @if(is_null($service->id))
                    <h3>Ajouter un nouveau service</h3>
                @else
                    <h3>Modifier le service <strong>{{$service->service}}</strong></h3>
                @endif
                @if(is_null($service->id))
                    <form method="post" action="{{url('admin/entreprises-detail/create-service')}}" class="form">
                @else
                    <form  method="post" action="{{url('admin/entreprise-detail/update-service')}}" class="form">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="id" value="{{$service->id}}">
                @endif
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="entreprise_id" value="{{ $entreprise->id }}">
                        <div class="form-group">
                            <label for="service">Service</label>
                            <input class="form-control" name="service" id="service" type="text" value="{{$service->service}}" autocomplete="off" required="true">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description"  class="form-control">{{$service->description}}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </form>
            </div>
        </div>
    </div>
@endsection
