@extends(((Request::ajax()) ? 'admin.layout-ajax' : 'admin.layout'))
 @section('title')
    @parent
    | Publicités
@stop

 @section('content')
    <div id="page-inner" class="pubs">
        <div class="row">
            <div class="col-md-12">
                <h2 class="page-head-line"> Publicités</h2>
            </div>
            @if(Session::has('success'))
                <div class="alert alert-success">
                    <p>Section ajoutée</p>
                </div>
            @endif
            @include('admin.errors')
            <div class="col-md-6">
                <form class="form-inline" method="post" action="{{url('admin/pubs/pub-action')}}">
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
                                <th>Titre</th>
                                <th>Entreprise</th>
                                <th>Niveau</th>
                                <th>Description</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($pubs as $cat)
                                <tr>
                                    <td>
                                        <strong>
                                            <a style="float: left; width: 100%" class="ajax" href="{{ url('admin/pubs/pub/'.$cat->id) }}" title="Modifier">{{$cat->titre}} @if(!$cat->publie) - <span class="post-state">Brouillon</span>@endif</a>
                                        </strong>

                                        <div class="row-actions">
                                            <span class="edit"><a class="ajax" href="{{ url('admin/pubs/pub/'.$cat->id) }}">Modifier</a></span>
                                            |
                                            <span class="delete"><a class="ajax" href="{{ url('admin/pubs/pub-delete/'.$cat->id.'/'.$cat->image) }}">Supprimer </a>  </span>
                                        </div>
                                    </td>
                                    <td>{{$cat->entreprise}}</td>
                                    <td>{{$cat->position}}</td>
                                    <td>{{$cat->description}}</td>
                                    <td> <img style="width:120px" src="{{ asset('uploads/pub/'.$cat->image) }}" alt="{{$cat->description}}" /></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                @if(is_null($pub->id))
                    <h3>Ajouter une nouvelle pub</h3>
                @else
                    <h3>Modifier la pub <strong>{{$pub->titre}}</strong></h3>
                @endif

                @if(Session::has('error'))
                <div class="alert alert-danger">
                    <p>{{Session::get('error')}}</p>
                </div>
              @endif

                @if(is_null($pub->id))
                    <form method="post" action="{{url('admin/pubs/create-pub')}}" class="form" enctype="multipart/form-data">
                @else
                    <form  method="post" action="{{url('admin/pubs/update-pub')}}" class="form" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="id" value="{{$pub->id}}">
                @endif
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label for="pub">Titre</label>
                            <input class="form-control" name="titre" id="titre" type="text" value="{{$pub->titre}}" autocomplete="off" required="true">
                        </div>
                        <div class="form-group">
                            <label for="pub">Entreprise</label>
                            <input class="form-control" name="entreprise" id="entreprise" type="text" value="{{$pub->entreprise}}" autocomplete="off" required="true">
                        </div>
                        <div class="form-group">
                            <label for="pub">Lien</label>
                            <input class="form-control" name="lien" id="lien" type="text" value="{{$pub->lien}}" autocomplete="off" required="true">
                        </div>
                        <div class="form-group">
                            <label for="pub">Niveau</label>
                            <select id="niveau" name="niveau" class="form-control" required>
                                <option value="">-------</option>
                                <option value="4" @if($pub->niveau==4) selected @endif>Square 125x125</option>
                                <option value="3" @if($pub->niveau==3) selected @endif>Medium rectangle à droit 300x250</option>
                                <option value="2"  @if($pub->niveau==2) selected @endif>Wide droite 160x600</option>
                                <option value="1"  @if($pub->niveau==1) selected @endif>Partenaires 170x170</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description"  class="form-control">{{$pub->description}}</textarea>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">Publier</div>
                            <div class="panel-body">
                                <label for="post_status">État&nbsp;:</label>
                                <span id="post-status-display">Publié</span>
                                <label class="selectit">
                                    <input type="checkbox" name="publie" id="in-category-1" @if($pub->publie) checked @endif>
                                </label>
                            </div>
                            <div class="panel-footer">
                              <input type="file" name="fichier" value="" style="float:left; with:70%">
                                @if(!is_null($pub->id))
                                    <a class="ajax" style="color: red; margin-right: 30px" href="{{ url('admin/pubs/pub-delete/'.$pub->id) }}">Mettre à la corbeille</a>
                                @endif
                                <input name="save" type="submit" class="btn btn-primary" id="publish" value="Mettre à jour">
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>
@endsection
