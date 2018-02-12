@extends(((Request::ajax()) ? 'admin.layout-ajax' : 'admin.layout'))
@section('title')
    @parent
    | Editer un utilisateur
    @stop

    @section('content')         
    <div id="page-inner" class="users">
        <div class="row">
            <div class="col-md-12">
                <h2 class="page-head-line"> Editer un utilisateur <a href="{{ url('admin/users/edit') }}" class="btn btn-primary btn-sm ajax"><i class="fa fa-edit"></i> Ajouter</a></h2>
                @if(Session::has('success'))
                    <div class="alert alert-success">
                        <p>Utilisateur publié.</p>
                    </div>
                @endif
                @include('admin.errors')
            </div>
            <form  action="{{ url('admin/users/store') }}" method="post" id="post" class="form" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                @if(!is_null($user->id))
                    <input type="hidden" name="id" value="{{$user->id}}">
                @endif

                <div class="col-md-8">
                    <div class="panel panel-default">
                        <div class="panel-heading"></div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="nom">Nom</label>
                                <input type="text" name="name" value="{{$user->name}}" id="name" class="form-control" autocomplete="off" required="">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" value="{{$user->email}}" id="email" class="form-control" autocomplete="off" required="">
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" name="phone" value="{{$user->phone}}" id="phone" class="form-control" autocomplete="off" >
                            </div>
                            <div class="form-group">
                                @if($user->password=="")
                                    <label for="pass1">Mot de passe</label>
                                    <input type="password" name="password" id="pass1" class="form-control" autocomplete="off" required>
                                @else
                                    <label for="pass2">Nouveau mot de passe</label>
                                    <input type="password" name="password" id="pass2" class="form-control" autocomplete="off">
                                    <input type="password" value="{{$user->password}}" name="lastpass" id="lastpass" style="display: none" />
                                    <p class="description">Si vous voulez changer de mot de passe entrez un nouveau. Sinon laissez vide.</p>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">Rôle</div>
                        <div class="panel-body">
                            <label for="droit">Rôle</label>
                            <select name="droit" id="droit" class="form-control" required >
                                <option value=""></option>
                                <option value="{{config('application.editeur')}}" {{(config('application.editeur')==$user->droit)?'selected':''}}>Editeur</option>
                                <option value="{{config('application.administrateur')}}" {{(config('application.administrateur')==$user->droit)?'selected':''}}>Administrateur</option>
                            </select>
                        </div>
                        <div class="panel-footer">
                            @if(!is_null($user->id))
                                <a class="ajax" style="color: red; margin-right: 30px" href="{{ url('admin/users/destroy/'.$user->id) }}">Mettre à la corbeille</a>
                            @endif
                            <input name="save" type="submit" class="btn btn-primary" id="publish" value="Mettre à jour">
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection