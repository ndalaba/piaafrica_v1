@extends('front.layout')
@section('title')  @if(isset($section)) {{ $section->section }} @else {{ $all['q'] }} {{ $all['section'] }} {{ $all['ville'] }} @endif - adresses et numéros de téléphone des professionnels et entreprises  d'Afrique @stop
@section('description') {{config('application.name') }}, service gratuit d'information sur les entreprises. Annuaire de référence des professionnels. les professionnels sont sur piaafrica.com et vous donnent leurs informations commerciales et pratiques. @stop
@section('header')
    <div class="header-search fixed-height">
        @include('front.inc.search')

        <div class="page-heading contact-us-heading">
            <span></span> <!-- for dark-overlay on the bg -->

            <div class="container">
                @if(isset($section))
                    <h1>{{ $section->section }}</h1>
                @else
                <!--<h1>Annuaire des <span> sociétés de Guinée</span></h1>-->
                    <h1><span>{{ $all['q'] }} {{ $all['section'] }} {{ $all['ville'] }} </span></h1>
                @endif
                <div class="heading-link">
                    <a href="{{url('/')}}" title="Page d'accueil {{config('application.name')}}">Accueil</a>
                    <i>/</i>
                    <a href="{{ url('annuaire') }}" title="Annuaire entreprises africaines">Annuaire</a>
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
                                        <h2>{{ str_limit($section->description,100) }}   @if(isset($country)) - <a href="{{ url('recherche?q=&pays='.$country->slug.'&ville=&section=') }}">{{ $country->pays }}</a>@endif</h2>
                                    @else
                                        <h2>Résultats de la recherche
                                            <span>{{ $all['q'] }} {{ $all['section'] }} {{ $all['ville'] }} {{$all['pays']}}</span>
                                        </h2>
                                    @endif
                                    <div class="row clearfix">
                                        @if(count($entreprises))
                                            @include('front.entreprise.inc.entrepriselist',['entreprises'=>$entreprises])
                                            <div class="pagination-center">
                                                {!! str_replace('/?', '?', $entreprises->render()) !!}
                                            </div>
                                        @else
                                            <h3 style="width: 70%">Aucune entreprise ne correspond à votre recherche</h3>
                                        @endif
                                    </div>
                                    <!-- end .row -->
                                </div>
                            </div>
                            <!-- end .tabe-content -->

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
                                    <li class="{{ Request::is("annuaire/toutes-les-categories") ? 'active' : '' }}">
                                        <a href="{{ url('annuaire/toutes-les-categories') }}" title="Annuaire entreprises guinéennes"><i class="fa fa-star-o"></i>Toutes les catégories</a>
                                    </li>
                                    @foreach($sections as $s)
                                        <li class="{{ Request::is("annuaire/".$s->slug) ? 'active' : '' }}">
                                            <a href="{{ url('annuaire/'.$s->slug) }}" title="Annuaire entreprises guinéennes - {{ $s->section }} "><i class="fa {{$s->faimage}}"></i>{{ $s->section }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
