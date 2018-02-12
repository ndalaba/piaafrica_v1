@extends(((Request::ajax()) ? 'admin.layout-ajax' : 'admin.layout'))
@section('title')
    @parent
    | Les services de {{ config('application.name') }}
@stop
@section('content')
    <div id="page-inner" class="services">
        <div class="row">
            <div class="col-md-12">
                <h2 class="page-head-line">Les services de {{ config('application.name') }}
                    <a href="{{url('admin/services/edit/')}}" class="btn btn-primary" style="margin-left: 20px">Ajouter</a>
                </h2>
            </div>
            <div class="col-md-12">
                <div class="table-responsive" style="margin: 10px">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr>
                            <th><input type="checkbox" title="Tout sélectionner" id="select_all"></th>
                            <th>Service</th>
                            <th>Description</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($services as $service)
                            <tr>
                                <th>
                                    <input type="checkbox" name="post[]" value="{{$service->id}}">
                                </th>
                                <td>
                                    <strong style="float: left; width: 100%"><a  href="{{url('admin/services/edit/'.$service->id)}}" title="Modifier">{{ $service->service }}</a></strong>

                                    <div class="row-actions">
                                        <span><a href="{{url('admin/services/edit/'.$service->id)}}" title="Modifier cet élément">Modifier</a> | </span>
                                        <span><a class="ajax" style="color: red" class="submitdelete" title="Déplacer cet élément dans la Corbeille" href="{{url('admin/services/delete/'.$service->id)}}">Mettre à la Corbeille</a> </span>
                                    </div>
                                </td>
                                <td>{{ str_limit(strip_tags($service->description),150) }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {!! $services->render() !!}
            </div>
        </div>
    </div>

@endsection
