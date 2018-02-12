@extends(((Request::ajax()) ? 'admin.layout-ajax' : 'admin.layout'))
@section('title')
    @parent
    | Les contacts sur {{ config('application.name') }}
@stop
@section('content')
    <div id="page-inner" class="entreprises">
        <div class="row">
            <div class="col-md-12">
                <h2 class="page-head-line">Les contacts sur {{ config('application.name') }}
                    <a href="{{url('admin/contacts/edit')}}" class="btn btn-primary" style="margin-left: 20px">Ajouter</a>
                </h2>
            </div>
            <div class="col-md12">
                <form method="get" action="{{url('admin/contacts/contact-action')}}" class="form-inline">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div style="margin: 10px">
                        <div class="form-group">
                            <label>Sélectionnez l’action groupée</label>
                            <select name="action" class="form-control">
                                <option value="9999">Actions groupées</option>
                                <option value="{{config('application.annonceur')}}">Annonceur</option>
                                <option value="{{config('application.contact')}}">Normal</option>
                                <option value="trash">Supprimer</option>
                            </select>
                            <input type="submit" name="doaction" id="doaction" class="btn btn-primary action" value="Appliquer">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="name" placeholder="nom"/>
                            <input type="email" class="form-control" name="email" placeholder="email"/>
                            <select name="type" class="form-control">
                                <option value="">Type de compte</option>
                                <option value="{{config('application.annonceur')}}">Annonceur</option>
                                <option value="{{config('application.contact')}}">Normal</option>
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
                                <th>Nom</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Type</th>
                                <th>Pays</th>
                                <th>Date</th>
                                <th>Entreprise</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($contacts as $contact)
                                <tr>
                                    <th>
                                        <input type="checkbox" name="post[]" value="{{$contact->id}}">
                                    </th>
                                    <td>
                                        <strong style="float: left; width: 100%"><a class="ajax" href="{{url('admin/contacts/edit/'.$contact->id)}}" title="Modifier">{{ $contact->name }}</a></strong>

                                        <div class="row-actions">
                                            <span><a class="ajax" href="{{url('admin/contacts/edit/'.$contact->id)}}" title="Modifier cet élément">Modifier</a> | </span>
                                            <span><a class="ajax" style="color: red" class="submitdelete" title="Déplacer cet élément dans la Corbeille" href="{{url('admin/contacts/delete/'.$contact->id)}}">Mettre à la Corbeille</a> </span>
                                        </div>
                                    </td>
                                    <td><a href="#">{{$contact->email}}</a></td>
                                    <td>{{ $contact->phone }}</td>
                                    <td>{{$contact->type}}</td>
                                    <td>
                                        @if($contact->ville)
                                            {{$contact->ville->ville.'-'.$contact->ville->country->pays}}
                                        @endif
                                    </td>
                                    <td>{{ \App\Http\Models\Help::timestampToDate($contact->created_at ) }}</td>
                                    @if(count($contact->entreprises))
                                        <td>
                                            @foreach($contact->entreprises as $entreprise)
                                                <a href="{{ url('admin/entreprise/edit/'.$contact->id.'/'.$entreprise->id) }}">{{$entreprise->name}}</a>
                                            @endforeach
                                        </td>
                                    @else
                                        <td><a href="{{ url('admin/entreprise/edit/'.$contact->id.'/0') }}"> Ajouter</a>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </form>
                {!! str_replace('/?', '?', $contacts->render()) !!}
            </div>
        </div>
    </div>

@endsection