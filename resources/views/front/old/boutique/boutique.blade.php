@extends('front.layout')
@section('title') {{$boutique->titre}} - @parent @stop
@section('description'){{$boutique->description}}  ! - @parent @stop
@section('ogtitle') {{$boutique->titre}} @stop
@section('ogdescription') {{$boutique->description}} @stop
@section('ogimage') {{asset('uploads/logos/'.$boutique->principale)}} @stop

@section('content')

    <section id="page-head">
        <div class="container">
            <div class="row col-md-12">
                <div class="page-heading">
                    <h1> {{$boutique->titre}}</h1>
                </div>
            </div>
        </div>
    </section>
    <section id="detail">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="ads-detail">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="author-detail">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="author-avatar" style="position: initial; margin-bottom: 20px;">
                                                <img src="{{ asset('uploads/logos/'.$boutique->logo) }}" alt="{{$boutique->titre}}">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="author-detail-right">
                                                <div class="author-info">
                                                    <i class="fa fa-map-marker"></i>

                                                    <p><!--Address: -->{{$boutique->adresse.', '.$boutique->ville.', '.$boutique->pays}}, </p>
                                                </div>
                                                <div class="author-info">
                                                    <i class="fa fa-phone"></i>

                                                    <p><!--Phone: -->{{$user->phone}}</p>
                                                </div>
                                                <div class="author-info">
                                                    <i class="fa fa-globe"></i>

                                                    <p><!--Website: --><a class="col" href="http://{{$boutique->web}}" target="_blank"> {{$boutique->web}} </a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="author-detail">
                                    <h3 class="inner-heading">{{$boutique->slogan}}</h3>

                                    <p>{!! $boutique->description !!}</p>

                                    <a href="http://{{$boutique->web}}" target="_blank" class="btn btn-danger" style="width: 70%; margin: 10px"> Visiter notre site web</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @include('front.inc.largepub')
                <div class="col-md-12">
                    <div class="tabbable-panel">
                        <div class="tabbable-line">
                            <ul class="nav nav-tabs ">
                                <li class="active"><a href="#tab_default_1" data-toggle="tab"> Offres </a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_default_1">
                                    @foreach($annonces  as $annonce)
                                        @include('front.annonce.annonce_block',['annonce'=>$annonce])
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
