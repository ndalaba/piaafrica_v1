@extends('front.layout')
@section('title')  @if(isset($section)) {{ $section->section }} @elseif(isset($all)) {{ $all['q'] }} {{ $all['type'] }} {{ $all['section'] }} {{ $all['ville'] }}  {{$all['entreprise']}} {{$all['pays']}} @endif - Offre d'emploi en Afrique @stop
@section('description') {{config('application.name') }}, service gratuit d'information sur les annonces. Annonce de référence des professionnels. les professionnels sont sur piaafrica.com et vous donnent leurs informations commerciales et pratiques. @stop
@section('header')
    <div class="header-search fixed-height">
        @include('front.annonce.search')

        <div class="page-heading contact-us-heading">
            <span></span> <!-- for dark-overlay on the bg -->

            <div class="container">
                @if(isset($section))
                    <h1>Les offres d'emploi publiées dans {{ config('application.name') }} - {{ $section->section }} @if(isset($country)) - <a href="{{ url('emplois/recherche?q=&type=&pays='.$country->slug.'&ville=&entreprise=&section=') }}">{{ $country->pays }}</a>@endif</h1>
                @elseif(isset($all))
                <!--<h1>Annonce des <span> sociétés de Guinée</span></h1>-->
                    <h1><span>Les offres d'emploi publiées dans {{ config('application.name') }} - {{ $all['q'] }} {{ $all['type'] }} {{ $all['section'] }} {{ $all['ville'] }}  {{$all['entreprise']}} {{$all['pays']}} </span></h1>
                @else
                    <h1>Toutes les offres d'emploi publiées dans {{config('application.name')}} @if(isset($country)) - <a href="{{ url('emplois/recherche?q=&type=&pays='.$country->slug.'&ville=&entreprise=&section=') }}">{{ $country->pays }}</a>@endif</h1>
                @endif
                <div class="heading-link">
                    <a href="{{url('/')}}" title="Page d'accueil {{config('application.name')}}">Accueil</a>
                    <i>/</i>
                    <a href="{{ url('emploi') }}" title="Offre d'emploi en afrique">Emploi</a>
                </div>

            </div>
                          <!-- END .container-->
        </div>
    </div>
    <div class="header-nav-bar">
        <div class="container">
            @include('front.inc.menu')
        </div>
        <!-- end .container -->
    </div>
@stop
@section('content')

    <div id="page-content">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-md-push-3">
                    <div class="page-content">
                        <div class="view-switch product-details-list">
                            <div class="tab-content">
                                <div class="tab-pane active">
                                    @if(isset($section))
                                        <h2>{{ str_limit($section->description,100) }}   @if(isset($country)) -
                                            <a href="{{ url('emploi/recherche?q=&pays='.$country->slug.'&ville=&section=') }}">{{ $country->pays }}</a>@endif
                                        </h2>
                                    @elseif(isset($all))
                                        <h2>Résultats de la recherche
                                            <span>{{ $all['q'] }} {{ $all['type'] }} {{ $all['section'] }} {{ $all['ville'] }}  {{$all['entreprise']}} {{$all['pays']}}</span>
                                        </h2>
                                    @else
                                        <h2>Offres d'emploi @if(isset($country)) -
                                            <a href="{{ url('emploi/recherche?q=&pays='.$country->slug.'&ville=&section=') }}">{{ $country->pays }} </a> @else  Afrique @endif</h2>
                                    @endif
                                    <div class="row clearfix">
                                        @if(count($annonces))
                                            @include('front.annonce.inc.annoncelist',['annonces'=>$annonces])
                                            <div class="pagination-center">
                                                {!! str_replace('/?', '?', $annonces->render()) !!}
                                            </div>
                                        @else
                                            <h3 style="width: 70%">Aucune annonce ne correspond à votre recherche</h3>
                                        @endif
                                    </div>
                                    <!-- end .row -->
                                </div>
                            </div>
                            <!-- end .tabe-content -->

                            @include('front.inc.pub-add')
                            @include('front.inc.pub-add')

                        </div>
                        <!-- end .product-details -->
                    </div>
                    <!-- end .page-content -->
                </div>
                <div class="col-md-3 col-md-pull-9 category-toggle">
                    <button><i class="fa fa-briefcase"></i></button>
                    <div class="page-sidebar">
                        <div id="categories">
                            <div class="accordion">
                                <ul class="nav nav-tabs accordion-tab" role="tablist">
                                    <li class="{{ Request::is("emploi/toutes-les-categories") ? 'active' : '' }}">
                                        <a href="{{ url('emploi/toutes-les-categories') }}" title="Offre d'emploi en afrique"><i class="fa fa-star-o"></i>Toutes les catégories</a>
                                    </li>
                                    @foreach($sections as $s)
                                        <li class="{{ Request::is("emploi/".$s->slug) ? 'active' : '' }}">
                                            <a href="{{ url('emploi/'.$s->slug) }}" title="Offre d'emploi en afrique - {{ $s->section }} "><i class="fa {{$s->faimage}}"></i>{{ $s->section }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    @include('front.inc.pub-square')
                </div>
            </div>
        </div>
    </div>
@stop
