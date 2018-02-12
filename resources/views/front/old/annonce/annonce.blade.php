@extends('front.layout')
@section('title') {{$annonce->titre}} - @parent @stop
@section('description'){{$annonce->description}}  ! - @parent @stop
@section('ogtitle') {{$annonce->titre}} @stop
@section('ogdescription') {{$annonce->description}} @stop
@section('ogimage') {{asset('uploads/images/'.$annonce->logo)}} @stop

@section('content')

    <section id="page-head">
        <div class="container">
            <div class="row col-md-12">
                <div class="page-heading">
                    <h1>{{$annonce->titre}}</h1>
                    <h4>{{\App\Http\Models\Help::toMoney($annonce->prix,$annonce->monnaie)}}</h4>
                </div>
            </div>
        </div>
    </section>
    <section id="detail">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="ads-detail">

                        @include('front.annonce.slider')

                        @include('front.annonce.addetail')
                        <!--end ad-detail-->
                    </div>
                    <!--advertisement-->
                    @include('front.inc.largepub')
                    @include('front.annonce.related')
                </div>
                <div class="col-md-4">
                    @if($annonce->user_id!=11)
                    <div class="panel panel-default">
                        <div class="panel-heading" style="font-weight: bold;text-align: center;background-image: none;">{{$annonce->user->name}}</div>
                        <div class="panel-body" style="text-align: center">
                            <!--<a href="#" class="btn btn-danger" style="width: 70%; margin: 10px"><i class="fa fa-phone"></i> Voir le numero</a>-->
                            <a href="{{url('annonce/message/'.$annonce->id)}}" class="btn btn-info" style="width: 70%; margin: 10px"><i class="fa fa-envelope"></i> Envoyer un email</a>
                        </div>
                    </div>
                    @endif
                    <div class="panel panel-default">
                        <div class="panel-heading" style="font-weight: bold;text-align: center;background-image: none;">Gérer votre annonce</div>
                        <div class="panel-body" style="text-align: center">
                            <a href="{{url('publier-annonce/'.$annonce->id)}}" style="width: 50%;margin: 10px 0px;display: block;float: left;font-weight: bold;"><i class="fa fa-pencil fa-2x"></i> Modifier l'annonce</a>
                            <a href="{{url('annonces/delete/'.$annonce->id)}}" style="width: 50%;margin: 10px 0px;display: block;float: left;font-weight: bold;"><i class="fa fa-remove fa-2x"></i> Supprimer l'annonce</a>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" style="font-weight: bold;text-align: center;background-image: none;">Publicité</div>
                        <div class="panel-body" style="text-align: center">
                            <div class="side-widget">
                                @include('front.inc.sidepub')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('front.inc.share')
@stop
