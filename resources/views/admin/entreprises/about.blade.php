@extends(((Request::ajax()) ? 'admin.layout-ajax' : 'admin.layout'))
@section('title')
    @parent
    | A Propos de {{ $entreprise->name }}
@stop

@section('content')
    @include('admin.inc.tinymce')
    <div id="page-inner" class="entreprises">
        <div class="row">
            <div class="col-md-12">
                <h2 class="page-head-line">
                    A Propos de
                    <a href="{{ url('admin/entreprises/edit/'.$entreprise->user_id.'/'.$entreprise->id) }}" class="btn btn-primary btn-sm ajax"><i class="fa fa-backward"></i>  {{ $entreprise->name }}
                    </a>
                </h2>
            </div>
            @if(Session::has('success'))
                <div class="alert alert-success">
                    <p>Enregistré</p>
                </div>
            @endif
            @include('admin.errors')
            <div class="col-md-12">
                <form method="post" action="{{url('admin/entreprise-detail/about/'.$entreprise->id)}}" class="form">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="entreprise_id" value="{{$entreprise->id}}"/>

                    <div class="form-group">
                        <label for="facebook">Facebook</label>
                        <input type="text" name="facebook" value="{{$about->facebook}}" id="facebook" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="twitter">Twitter</label>
                        <input type="text" name="twitter" value="{{$about->twitter}}" id="twitter" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="googleplus">Google+</label>
                        <input type="text" name="googleplus" value="{{$about->googleplus}}" id="googleplus" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="linkedin">Linkedid</label>
                        <input type="text" name="linkedin" value="{{$about->linkedin}}" id="linkedin" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="contenu" class="form-control" style="height: 400px;">{!! $about->description !!}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </form>
            </div>
        </div>
    </div>
@endsection
