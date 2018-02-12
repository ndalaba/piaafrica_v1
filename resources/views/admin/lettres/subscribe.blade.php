@extends(((Request::ajax()) ? 'admin.layout-ajax' : 'admin.layout'))
@section('title')
    @parent
    | Ajouter des mails
@stop

@section('content')
    <div id="page-inner" class="lettres publierApp">
        <div class="row">
            <div class="col-md-12">
                <h2 class="page-head-line"> Ajouter des mails
                    <a href="{{ url('admin/emails') }}" class="btn btn-primary btn-sm ajax"><i class="fa fa-list-alt"></i> Liste lettres</a>

                    <a href="{{url('admin/lettres/subscribe/')}}" class="btn btn-info" style="margin-left: 20px; float: right">Ajouter</a>
                </h2>
                @if(Session::has('success'))
                    <div class="alert alert-success">
                        <p>Mails ajoutés.</p>
                    </div>
                @endif
                @include('admin.errors')
            </div>
            <form action="{{ url('admin/lettres/subscribe') }}" method="post" id="post" class="form" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="col-md-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Emails séparés par des points virgules
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="country_id">Pays</label>
                                <select name="country_id" id="country_id"  class="form-control">
                                    <option></option>
                                    @foreach($countries as $country)
                                        <option value="{{$country->id}}" >{{ $country->pays }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="emails">Emails</label>
                                <textarea name="emails" id="emails" class="form-control"></textarea>
                            </div>
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