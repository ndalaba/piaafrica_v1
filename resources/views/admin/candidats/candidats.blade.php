@extends(((Request::ajax()) ? 'admin.layout-ajax' : 'admin.layout'))
@section('title')
    @parent
    | Les candidats sur {{ config('application.name') }}
@stop
@section('content')
    <div id="page-inner" class="annonces">
        <div class="row">
            <div class="col-md-12">
                <h2 class="page-head-line">Les candidats sur {{ config('application.name') }}
                    <a href="{{url('admin/candidats/edit')}}" class="btn btn-primary" style="margin-left: 20px">Ajouter</a>
                </h2>
            </div>
            <div class="col-md12">
                <form method="post" action="{{url('admin/candidats/candidat-action')}}" class="form-inline">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div style="margin: 10px">
                        <div class="form-group">
                            <label>Sélectionnez l’action groupée</label>
                            <select name="action" class="form-control">
                                <option value="-1" selected="selected">Actions groupées</option>
                                <option value="part" selected="selected">Marque comme particulier</option>
                                <option value="pro" selected="selected">Marque comme professionnel</option>
                                <option value="trash">Déplacer dans la Corbeille</option>
                            </select>
                            <input type="submit" name="doaction" id="doaction" class="btn btn-primary action" value="Appliquer">
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
                                <th>Date</th>
                                <th>Pays</th>
                                <th>Publie</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($candidats as $candidat)
                                <tr>
                                    <th>
                                        <input type="checkbox" name="post[]" value="{{$candidat->id}}">
                                    </th>
                                    <td>
                                        <strong style="float: left; width: 100%"><a href="{{$candidat->link}}" title="Modifier" target="_blank">{{ $candidat->name }}</a></strong>

                                        <div class="row-actions">
                                            <span><a href="{{url('admin/candidats/edit/'.$candidat->id)}}" title="Modifier cet élément">Modifier</a> | </span>
                                            <span><a style="color: red" class="submitdelete" title="Déplacer cet élément dans la Corbeille" href="{{url('admin/candidats/delete/'.$candidat->id)}}">Mettre à la Corbeille</a> </span>
                                        </div>
                                    </td>
                                    <td><a href="#">{{$candidat->email}}</a></td>
                                    <td>{{ $candidat->phone }}</td>
                                    <td>{{ \App\Http\Models\Help::timestampToDate($candidat->created_at ) }}</td>
                                    <td>
                                        @if($candidat->ville)
                                            {{$candidat->ville->ville.'-'.$candidat->ville->country->pays}}
                                        @endif
                                    </td>
                                    <td>
                                        @if($candidat->candidat)
                                            {!! $candidat->candidat->etat !!}
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </form>
                {!! $candidats->render() !!}
            </div>
        </div>
    </div>

@endsection