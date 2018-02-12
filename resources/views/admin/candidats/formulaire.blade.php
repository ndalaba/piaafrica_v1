@extends(((Request::ajax()) ? 'admin.layout-ajax' : 'admin.layout'))
@section('title')
    @parent
    | Editer un contact
@stop

@section('content')
    <div id="page-inner" class="annonces">
        <div class="row">
            <div class="col-md-12">
                <h2 class="page-head-line"> Editer un contact
                    <a href="{{ url('admin/contacts') }}" class="btn btn-primary btn-sm ajax"><i class="fa fa-list-alt"></i> Liste contacts</a>
                    <a href="{{ url('admin/contacts/edit') }}" class="btn btn-primary btn-sm ajax"><i class="fa fa-pencil"></i> Ajouter</a>
                </h2>
                @if(Session::has('success'))
                    <div class="alert alert-success">
                        <p>Contact publié.</p>
                    </div>
                @endif
                @include('admin.errors')
            </div>
            <form  action="{{ url('admin/contacts/store') }}" method="post" id="post" class="form" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                @if(!is_null($contact->id))
                    <input type="hidden" name="id" value="{{$contact->id}}">
                @endif

                <div class="col-md-8">
                    <div class="panel panel-default">
                        <div class="panel-heading"></div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="nom">Nom</label>
                                <input type="text" name="name" value="{{$contact->name}}" id="name" class="form-control" autocomplete="off" required="">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" value="{{$contact->email}}" id="email" class="form-control" autocomplete="off" required="">
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" name="phone" value="{{$contact->phone}}" id="phone" class="form-control" autocomplete="off" >
                            </div>
                            <div class="form-group">
                                @if($contact->password=="")
                                    <label for="pass1">Mot de passe</label>
                                    <input type="password" name="password" id="pass1" class="form-control" autocomplete="off" required>
                                @else
                                    <label for="pass2">Nouveau mot de passe</label>
                                    <input type="password" name="password" id="pass2" class="form-control" autocomplete="off">
                                    <input type="password" value="{{$contact->password}}" name="lastpass" id="lastpass" style="display: none" />
                                    <p class="description">Si vous voulez changer de mot de passe entrez un nouveau. Sinon laissez vide.</p>
                                @endif
                            </div>

                        </div>
                    </div>
                    <input name="save" type="submit" class="btn btn-primary" id="publish" value="Enregistrer">
                </div>
            </form>
        </div>
    </div>
@endsection