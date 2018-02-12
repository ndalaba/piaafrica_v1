@extends('front.layout')
@section('title') La cvthèques - {{config('application.name')}} @stop
@section('header')
    <div class="header-search fixed-height">
        @include('front.candidat.search')

        <div class="page-heading blog-list-heading">
            <span></span> <!-- for dark-overlay on the bg -->

            <div class="container">

                <h1>Notre cvthèques</h1>

                <div class="heading-link">
                    <a href="{{url('/')}}" title="Page d'accueil {{ config('application.name')}}">Accueil</a>

                    <i>/</i>

                    <a href="{{ url('cvtheques') }}" title="Notre cvthèques">CVThèques</a>
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
            <div class="page-content bl-list">
                <div class="row">
                    <div class="col-md-8">
                        <div class="product-details-list">
                            <div class="tab-content">
                                <div class="tab-pane active" id="category-book">
                                    @if(isset($all))
                                        <h3>Résultats de la recherche
                                            <span>{{ $all['q'] }} {{ $all['civilite'] }} {{ $all['pays'] }} {{$all['ville']}} {{$all['niveau']}} {{$all['langue']}}</span>
                                        </h3>
                                    @else
                                        <h3>
                                            Notre collection de CV
                                            @if(isset($country)) -
                                            <a href="{{ url('recherche?q=&civilite=&pays='.$country->slug.'&ville=&niveau=&langue=&order=id+DESC') }}">{{ $country->pays }}</a>
                                            @endif
                                        </h3>
                                    @endif
                                    <div class="row clearfix">
                                        @if(count($candidats))
                                            @foreach($candidats as $candidat)
                                                <div class="col-md-12">

                                                    <div class="single-product">
                                                        @if($candidat->candidat && !empty($candidat->candidat->photo))
                                                            <figure style="margin-bottom: 0px">
                                                                <img src="{{asset('uploads/candidats/photos/'.$candidat->candidat->photo)}}" alt="{{ $candidat->name}}" style="max-width: 100%">
                                                            </figure>
                                                        @endif

                                                        <h4>
                                                            <a href="{{$candidat->link}}" title="{{ $candidat->name}}">{{ $candidat->name}}</a>
                                                        </h4>

                                                        <h5>
                                                            {{$candidat->fonction}}
                                                            @if($candidat->candidat && $candidat->ville )
                                                                |   {{$candidat->candidat->niveau}} |  {{$candidat->candidat->langue}} |  {{$candidat->ville->country->pays}} | {{ \App\Http\Models\Help::timestampToDate($candidat->candidat->naissance) }}
                                                            @endif
                                                        </h5>
                                                        @if($candidat->candidat)
                                                            <p>{{$candidat->candidat->specialite}}</p>
                                                        @endif

                                                        <a class="read-more" href="{{$candidat->link}}" title="En savoir plus sur {{ $candidat->name}} "><i class="fa fa-angle-right"></i>Détails</a>

                                                    </div>
                                                    <!-- end .single-product -->
                                                </div>
                                            @endforeach
                                        @else
                                            <h3>Aucun cv n'est disponible dans votre zone </h3>
                                        @endif
                                    </div>
                                    <!-- end .row -->
                                </div>
                                <!-- end .tabe-pane -->
                            </div>
                        </div>
                        <div class="blog-list-pagination">
                            {!! $candidats->render() !!}
                        </div>

                    </div>
                    <!-- end .grid-layout -->

                    <div class="col-md-4">
                        @include('front.candidat.sidebar')
                        <!-- end .post-sidebar -->
                    </div>
                    <!-- end .grid-layout -->

                </div>
                <!-- end .row -->
            </div>
            <!-- end .page-content -->
        </div>
        <!-- end .container -->

    </div>
@stop
