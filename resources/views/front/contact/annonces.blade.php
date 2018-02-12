@extends('front.layout')
@section('title') Compte {{ config('application.name') }} de {{ \Auth::user()->name }} - @parent @stop
@section('header')
    <div class="header-search fixed-height">
        @include('front.annonce.search')

        <div class="page-heading blog-list-heading">
            <span></span>

            <div class="container">

                <h1>Bonjour {{ \Auth::user()->name }}, Vos offres d'emploi</h1>

                <div class="heading-link">
                    <a href="{{url('/')}}" title="Page d'accueil {{config('application.name')}}">Accueil</a>
                </div>

            </div>
        </div>
    </div>
    <div class="header-nav-bar">
        <div class="container">
            @include('front.contact.menu')
        </div>
    </div>
@stop

@section('content')
    <div id="page-content">
        <div class="container">
            <div class="page-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="page-content">
                            <div class="view-switch product-details-list">
                                <div class="tab-content">
                                    <div class="tab-pane active">
                                        <h2>Mes offres d'emploi     <a class="btn btn-sm" href="{{ url('mes-offres/annonce') }}">Ajouter une offre</a></h2>
                                        <div class="row clearfix">
                                            @foreach($annonces as $val)
                                                <div class="col-sm-4 col-xs-6">
                                                    <div class="single-product">
                                                        @if($val->entreprise)
                                                            <figure style="width:180px">
                                                                @if($val->entreprise->logo!=null)
                                                                    <a href="{{$val->entreprise->link}}" title="{{ $val->entreprise->name }}" target="_blank">
                                                                        <img src="{{ $val->entreprise->imagelink }}" alt="{{$val->entreprise->name}}">
                                                                    </a>
                                                                @endif
                                                            </figure>
                                                        @endif
                                                        <h4><a href="{{$val->link}}" title="{{ $val->titre }}">{{ $val->titre }}</a></h4>
                                                        <h6>
                                                            {{ \App\Http\Models\Help::timestampToDate($val->fin) }} |
                                                            {{$val->type}} |
                                                            <a href="{{ url('emploi/'.$val->section->slug) }}" title="{{ $val->section->section }}">{{ $val->section->section }}</a> |
                                                            @if($val->entreprise)  <a href="{{ url('emplois/recherche?q=&type=&pays=&ville=&section=&entreprise='.$val->entreprise->slug) }}" title="{{ $val->entreprise->name }}">{{ $val->entreprise->name }}</a> |  @endif
                                                            {{$val->ville->ville}}-{{$val->ville->country->pays}}
                                                        </h6>

                                                            <div class="btn-group-vertical" role="group" aria-label="Default button group">
                                                                <a   class="btn btn-sm"><i class="fa fa-file"></i> {{ $val->etat }}</a>
                                                                <a  href="{{url('mes-offres/annonce/'.$val->id)}}" title="Modifier cet élément" class="btn btn-sm"><i class="fa fa-pencil"></i> Modifier l'annonce</a>
                                                                <a style="background-color: darkred" title="Déplacer cet élément dans la Corbeille" href="{{url('mes-offres/annonces/suppimer/'.$val->id)}}" class="btn btn-sm deleteAnnonce"><i class="fa fa-trash"></i> Supprimer l'annonce</a>
                                                            </div>
                                                    </div>

                                                </div>
                                            @endforeach
                                                <div class="pagination-center">
                                                    {!! str_replace('/?', '?', $annonces->render()) !!}
                                                </div>
                                        </div>
                                        <!-- end .row -->
                                    </div>
                                </div>
                                <!-- end .tabe-content -->
                            </div>
                            <!-- end .product-details -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
