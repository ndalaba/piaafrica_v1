@extends(((Request::ajax()) ? 'admin.layout-ajax' : 'admin.layout'))
@section('title')
    @parent
    | Editer une service
@stop

@section('content')
    @include('admin.inc.tinymce')
    <div id="page-inner" class="services publierApp">
        <div class="row">
            <div class="col-md-12">
                <h2 class="page-head-line"> Editer un service
                    <a href="{{ url('admin/services') }}" class="btn btn-primary btn-sm ajax"><i class="fa fa-list-alt"></i> Liste services</a>

                    <a href="{{url('admin/services/edit/')}}" class="btn btn-info" style="margin-left: 20px; float: right">Ajouter</a>
                </h2>
                @if(Session::has('success'))
                    <div class="alert alert-success">
                        <p>Service publié.</p>
                    </div>
                @endif
                @include('admin.errors')
            </div>
            <form action="{{ url('admin/services/store') }}" method="post" id="post" class="form" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                @if(!is_null($service->id))
                    <input type="hidden" name="id" value="{{$service->id}}">
                @endif
                <div class="col-md-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Details services
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="titre">Service</label>
                                <input type="text" name="service" value="{{$service->service}}" id="name" class="form-control" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="description">Contenu</label>
                                <textarea name="description" id="contenu" class="form-control" style="height: 380px">{{$service->description}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-footer">
                            <div class="form-group">
                                <label for="logo">Image</label>
                                <input type="file" name="fichier" value="logo" title="logo" id="fichier">
                                <input type="hidden" name="image" value="{{$service->image}}" title="logo" id="fichier">

                                <p class="help-block">'png', 'gif', 'jpg', 'jpeg'</p>

                                <img src="{{$service->imagelink}}" style="max-width: 100%;margin: 5px;"/>
                            </div>
                            <input name="save" type="submit" class="btn btn-primary" id="publish" value="Enregistrer">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection