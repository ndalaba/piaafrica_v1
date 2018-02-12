@extends('front.layout')
@section('title') Compte {{ config('application.name') }} de {{ \Auth::user()->name }} - @parent @stop
@section('header')
    <div class="header-search fixed-height">
        @include('front.inc.search')

        <div class="page-heading blog-list-heading">
            <span></span>

            <div class="container">

                <h1>Bonjour {{ \Auth::user()->name }}, Vos entreprises</h1>

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
                                        <h2>Mes entreprises <a class="btn btn-sm" href="{{ url('publier-entreprise') }}">Ajouter une entreprise</a></h2>
                                        <div class="row clearfix">
                                            @if(count($entreprises))
                                                @foreach($entreprises as $val)
                                                    <div class="col-sm-4 col-xs-6">
                                                        <div class="single-product">
                                                            <figure>
                                                                @if($val->logo!=null)
                                                                    <img src="{{ $val->imagelink }}" alt="{{$val->name}}">
                                                                @endif
                                                            </figure>
                                                            <h4><a href="{{$val->link}}" title="{{ $val->name }}">{{ $val->name }}</a></h4>
                                                            <h5>{{ $val->domaine }} - <a href="{{ url('entreprise/'.$val->section->slug) }}" title="{{ $val->section->section }}">{{ $val->section->section }}</a></h5>

                                                            <p>{{ $val->adresses[0]->adresse }}.-{{$val->ville->ville}}</p>

                                                            <div class="btn-group-vertical" role="group" aria-label="Default button group">
                                                                <a   class="btn btn-sm"><i class="fa fa-file"></i> {{ $val->etat }}</a>
                                                                <a   class="btn btn-sm"><i class="fa fa-file"></i> {{ $val->position }}</a>
                                                                <a  href="{{url('publier-entreprise/'.$val->id)}}" title="Modifier cet élément" class="btn btn-sm"><i class="fa fa-pencil"></i> Modifier l'entreprise</a>
                                                                <a style="background-color: darkred" title="Déplacer cet élément dans la Corbeille" href="{{url('entreprises/delete/'.$val->id)}}" class="btn btn-sm deleteEntreprise"><i class="fa fa-trash"></i> Supprimer l'entreprise</a>
                                                            </div>
                                                        </div>

                                                    </div>
                                                @endforeach

                                                <div class="pagination-center">
                                                    {!! str_replace('/?', '?', $entreprises->render()) !!}
                                                </div>
                                            @else
                                                <h3 style="width: 70%">Aucune entreprise</h3>
                                            @endif
                                        </div>
                                        <!-- end .row -->
                                    </div>
                                </div>
                                <!-- end .tabe-content -->
                                @include('front.inc.pub-medium')
                            </div>
                            <!-- end .product-details -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
