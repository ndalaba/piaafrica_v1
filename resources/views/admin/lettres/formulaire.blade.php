@extends(((Request::ajax()) ? 'admin.layout-ajax' : 'admin.layout'))
@section('title')
    @parent
    | Editer une lettre
@stop

@section('content')
    @include('admin.inc.tinymce')
    <div id="page-inner" class="lettres publierApp">
        <div class="row">
            <div class="col-md-12">
                <h2 class="page-head-line"> Editer une lettre
                    <a href="{{ url('admin/lettres') }}" class="btn btn-primary btn-sm ajax"><i class="fa fa-list-alt"></i> Liste lettres</a>

                    <a href="{{url('admin/lettres/edit/')}}" class="btn btn-info" style="margin-left: 20px; float: right">Ajouter</a>
                </h2>
                @if(Session::has('success'))
                    <div class="alert alert-success">
                        <p>Lettre publiée.</p>
                    </div>
                @endif
                @include('admin.errors')
            </div>
            <form action="{{ url('admin/lettres/store') }}" method="post" id="post" class="form" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                @if(!is_null($lettre->id))
                    <input type="hidden" name="id" value="{{$lettre->id}}">
                @endif
                <div class="col-md-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Details lettres
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="titre">Lettre</label>
                                <input type="text" name="titre" value="{{$lettre->titre}}" id="name" class="form-control" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="description">Contenu</label>
                                <textarea name="contenu" id="contenu" class="form-control" style="height: 380px">{{$lettre->contenu}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">Pays de la lettre</div>
                        <div class="panel-body">
                            <label for="country_id">Pays de la lettre</label>
                            <select name="country_id" id="country_id"  class="form-control">
                                <option></option>
                                @foreach($countries as $country)
                                    <option value="{{$country->id}}"   @if($country->id==$lettre->country_id) selected @endif>{{ $country->pays }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">Publie</div>
                        <div class="panel-body">
                            <label for="post_status">État&nbsp;:</label>
                            <span id="post-status-display">Publié</span>
                            <label class="selectit">
                                <input type="checkbox" name="publie" id="in-category-1" @if($lettre->publie) checked @endif>
                            </label>
                        </div>
                        <div class="panel-footer">
                            <input name="save" type="submit" class="btn btn-primary" id="publish" value="Enregistrer">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection