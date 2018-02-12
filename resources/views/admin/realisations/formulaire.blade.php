@extends(((Request::ajax()) ? 'admin.layout-ajax' : 'admin.layout'))
@section('title')
    @parent
    | Editer une realisation
@stop

@section('content')
    <div id="page-inner" class="realisations publierApp">
        <div class="row">
            <div class="col-md-12">
                <h2 class="page-head-line"> Editer une realisation
                    <a href="{{ url('admin/realisations') }}" class="btn btn-primary btn-sm ajax"><i class="fa fa-list-alt"></i> Liste réalisations</a>
                </h2>
                @if(Session::has('success'))
                    <div class="alert alert-success">
                        <p>Realisation publiée.</p>
                    </div>
                @endif
                @include('admin.errors')
            </div>
            <form action="{{ url('admin/realisations/store') }}" method="post" id="post" class="form" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                @if(!is_null($realisation->id))
                    <input type="hidden" name="id" value="{{$realisation->id}}">
                @endif
                <div class="col-md-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Details realisations
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="titre">Réalisation</label>
                                <input type="text" name="realisation" value="{{$realisation->realisation}}" id="realisation" class="form-control" required="" ">
                            </div>
                            <div class="form-group">
                                <label for="titre">URL</label>
                                <input type="url" name="url" value="{{$realisation->url}}" id="url" class="form-control" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control" style="height: 200px">{{$realisation->description}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">Service réalisation</div>
                        <div class="panel-body">
                            <label for="categorie_id">Service réalisation</label>
                            <select name="gservice_id" id="gservice_id" required class="form-control">
                                <option value=""></option>
                                @foreach($services as $s)
                                    <option value="{{$s->id}}"   @if($s->id==$realisation->gservice_id) selected @endif>{{ $s->service }}</option>
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
                                <input type="checkbox" name="publie" id="in-category-1" @if($realisation->publie) checked @endif>
                            </label>
                        </div>
                        <div class="panel-footer">
                            <div class="form-group">
                                <label for="logo">Image</label>
                                <input type="hidden" name="images" value="{{$realisation->images}}" title="logo" id="fichier">

                                <div class="btn btn-default image-preview-input">
                                    <span class="glyphicon glyphicon-folder-open"></span>
                                    <span class="image-preview-input-title n1">Image N°1</span>
                                    <input type="file" accept="image/png, image/jpeg, image/gif" name="image[]"  data-num="n1"/>
                                </div>
                                <div class="btn btn-default image-preview-input">
                                    <span class="glyphicon glyphicon-folder-open"></span>
                                    <span class="image-preview-input-title n2">Image N°2</span>
                                    <input type="file" accept="image/png, image/jpeg, image/gif" name="image[]" data-num="n2"/>
                                </div>
                                <div class="btn btn-default image-preview-input">
                                    <span class="glyphicon glyphicon-folder-open"></span>
                                    <span class="image-preview-input-title n3">Image N°3</span>
                                    <input type="file" accept="image/png, image/jpeg, image/gif" name="image[]"  data-num="n3"/>
                                </div>
                            </div>
                            <input name="save" type="submit" class="btn btn-primary" id="publish" value="Enregistrer">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection