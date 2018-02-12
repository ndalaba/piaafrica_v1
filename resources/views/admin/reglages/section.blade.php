@extends(((Request::ajax()) ? 'admin.layout-ajax' : 'admin.layout'))
@section('title')
    @parent
    | Sections catégories annonces
@stop

@section('content')
    <div id="page-inner" class="sections">
        <div class="row">
            <div class="col-md-12">
                <h2 class="page-head-line"> Sections catégories annonces</h2>
            </div>
            @if(Session::has('success'))
                <div class="alert alert-success">
                    <p>Section ajoutée</p>
                </div>
            @endif
            @include('admin.errors')
            <div class="col-md-6">
                <form class="form-inline" method="post" action="{{url('admin/sections/section-action')}}">
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
                                <th>Section</th>
                                <th>Description</th>
                                <th>Fa Image</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sections as $cat)
                                <tr>
                                    <td>
                                        <strong>
                                            <a  style="float: left; width: 100%" class="ajax" href="{{ url('admin/sections/section/'.$cat->id) }}" title="Modifier">{{$cat->section}}</a>
                                        </strong>

                                        <div class="row-actions">
                                            <span class="edit"><a class="ajax" href="{{ url('admin/sections/section/'.$cat->id) }}">Modifier</a></span>
                                            |
                                            <span class="delete"><a class="ajax" href="{{ url('admin/sections/section-delete/'.$cat->id) }}">Supprimer </a>  </span>
                                        </div>
                                    </td>
                                    <td>{{$cat->description}}</td>
                                    <td><i class="{{$cat->faimage}} fa-2x"></i></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                @if(is_null($section->id))
                    <h3>Ajouter une nouvelle section</h3>
                @else
                    <h3>Modifier la section <strong>{{$section->section}}</strong></h3>
                @endif
                @if(is_null($section->id))
                    <form method="post" action="{{url('admin/sections/create-section')}}" class="form">
                @else
                    <form  method="post" action="{{url('admin/sections/update-section')}}" class="form">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="id" value="{{$section->id}}">
                @endif
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label for="section">Section</label>
                            <input class="form-control" name="section" id="section" type="text" value="{{$section->section}}" autocomplete="off" required="true">
                        </div>
                        <div class="form-group">
                            <label for="section">Fa image</label>
                            <input class="form-control" name="faimage" id="faimage" type="text" value="{{$section->faimage}}" autocomplete="off" >
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description"  class="form-control">{{$section->description}}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </form>
            </div>
        </div>
    </div>
@endsection
