@extends(((Request::ajax()) ? 'admin.layout-ajax' : 'admin.layout'))
@section('title')
    @parent
    | Les emails sur {{ config('application.name') }}
@stop
@section('content')
    <div id="page-inner" class="lettres">
        <div class="row">
            <div class="col-md-12">
                <h2 class="page-head-line">Les emails sur {{ config('application.name') }}
                    <a href="{{url('admin/lettres/subscribe/')}}" class="btn btn-info" style="margin-left: 20px; float: right">Ajouter</a>
                </h2>

            </div>
            <div class="col-md12">
                <form method="get" action="{{url('admin/lettres/email-action')}}" class="form-inline">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div style="margin: 10px">
                        <div class="form-group">
                            <label>Sélectionnez l’action groupée</label>
                            <select name="action" class="form-control">
                                <option value="9999">Actions groupées</option>
                                <option value="0">Désabonner</option>
                            </select>
                            <input type="submit" name="doaction" id="doaction" class="btn btn-primary action" value="Appliquer">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" placeholder="email"/>
                            <select name="publie" class="form-control">
                                <option value="">Etat</option>
                                <option value="1">Publiés</option>
                                <option value="0">Non Publiés</option>
                            </select>
                            <select name="country_id" id="country_id" class="form-control">
                                <option value="">Pays</option>
                                @foreach($countries as $country)
                                    <option value="{{$country->id}}">{{ $country->pays }}</option>
                                @endforeach
                            </select>
                            <input type="submit" name="doaction" id="post-query-submit" class="btn btn-primary" value="Filtrer">
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                                <th><input type="checkbox" title="Tout sélectionner" id="select_all"></th>
                                <th>Email</th>
                                <th>Pays</th>
                                <th>Etat</th>
                                <th>Date</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($emails as $email)
                                <tr>
                                    <th>
                                        <input type="checkbox" name="post[]" value="{{$email->id}}">
                                    </th>
                                    <td><a href="#">{{$email->email}}</a></td>
                                    <td>
                                        @if($email->country)
                                            {{$email->country->pays}}
                                        @endif
                                    </td>
                                    <td>{{$email->etat}}</td>
                                    <td>{{ \App\Http\Models\Help::timestampToDate($email->created_at ,true) }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </form>
                {!! str_replace('/?', '?', $emails->render()) !!}
            </div>
        </div>
    </div>

@endsection