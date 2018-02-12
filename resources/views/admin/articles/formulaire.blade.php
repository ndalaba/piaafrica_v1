@extends(((Request::ajax()) ? 'admin.layout-ajax' : 'admin.layout'))
@section('title')
    @parent
    | Editer une article
@stop

@section('content')
    @include('admin.inc.tinymce')
    <div id="page-inner" class="articles publierApp">
        <div class="row">
            <div class="col-md-12">
                <h2 class="page-head-line"> Editer une article

                    @if(!is_null($article->id))
                        <a href="{{ $article->link  }}" target="_blank">Voir</a>
                    @endif
                    <a href="{{ url('admin/articles') }}" class="btn btn-primary btn-sm ajax"><i class="fa fa-list-alt"></i> Liste articles</a>

                    <a href="{{url('admin/articles/edit/')}}" class="btn btn-info" style="margin-left: 20px; float: right">Ajouter</a>
                </h2>
                @if(Session::has('success'))
                    <div class="alert alert-success">
                        <p>Article publiée.</p>
                    </div>
                @endif
                @include('admin.errors')
            </div>
            <form action="{{ url('admin/articles/store') }}" method="post" id="post" class="form" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                @if(!is_null($article->id))
                    <input type="hidden" name="id" value="{{$article->id}}">
                @endif
                <div class="col-md-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Details articles
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="titre">Article</label>
                                <input type="text" name="titre" value="{{$article->titre}}" id="name" class="form-control" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="description">Contenu</label>
                                <textarea name="contenu" id="contenu" class="form-control" style="height: 380px">{{$article->contenu}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">Section d'article</div>
                        <div class="panel-body">
                            <label for="categorie_id">Section d'article</label>
                            <select name="section_id" id="section_id" required class="form-control">
                                <option value=""></option>
                                @foreach($sections as $section)
                                    <option value="{{$section->id}}"   @if($section->id==$article->section_id) selected @endif>{{ $section->section }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">Entreprises</div>
                        <div class="panel-body entreprise">
                            <!--<label for="categorie_id">Entreprise</label>-->
                            <select name="entreprises[]" id="entreprise" class="form-control" multiple="multiple">
                                @foreach($entreprises as $entreprise)
                                    <option value="{{$entreprise->id}}" @if(array_key_exists($entreprise->id,$articleentreprises)) selected @endif>{{ $entreprise->name }} </option>
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
                                <input type="checkbox" name="publie" id="in-category-1" @if($article->publie) checked @endif>
                            </label>
                        </div>
                        <div class="panel-footer">
                            <div class="form-group">
                                <label for="logo">Image</label>
                                <input type="file" name="fichier" value="logo" title="logo" id="fichier">
                                <input type="hidden" name="image" value="{{$article->image}}" title="logo" id="fichier">

                                <p class="help-block">'png', 'gif', 'jpg', 'jpeg'</p>

                                <img src="{{$article->imagelink}}" style="max-width: 100%;margin: 5px;"/>
                            </div>
                            <input name="save" type="submit" class="btn btn-primary" id="publish" value="Enregistrer">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    @parent
    <script type="text/javascript">
        $(document).ready(function () {
            $('#entreprise').multiselect({
                enableFiltering: true
            });
        });
    </script>
@stop