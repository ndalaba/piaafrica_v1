@extends('front.layout')
@section('title') realisations de {{ config('application.name') }} - {{ $realisation->realisation }}@stop
@section('description') L'agence web de l'Afrique moderne, {{ config('application.name') }} - {{ str_limit(strip_tags($realisation->description),150) }}@stop
@section('header')
    <div class="header-search fixed-height">
        @include('front.inc.search')

        <div class="page-heading contact-us-heading">
            <span></span> <!-- for dark-overlay on the bg -->

            <div class="container">
                <h1>Les realisations de <span> {{ config('application.name') }}</span></h1>

                <div class="heading-link">
                    <a href="{{ url('/') }}" title="Page d'accueil {{ config('application.name')}} ">Accueil</a>
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
                    <div class="col-md-12">
                        <div class="product-details-list">
                            <div class="tab-content">
                                <div class="tab-pane active" id="category-book">
                                    <div class="row clearfix">
                                        <h3> {{ config('application.name') }} <span>{{ $realisation->realisation }}</span></h3>
                                        <div class="col-md-12">
                                            <div class="single-product">
                                                <!--<figure>
                                                    <img src="{{$realisation->imagelink}}" alt="{{$realisation->realisation}}">
                                                </figure>-->

                                                <p>{!! $realisation->description !!}</p>

                                            </div>
                                            <!-- end .single-product -->
                                        </div>




                                    </div>
                                    <!-- end .row -->
                                </div>
                                <!-- end .tabe-pane -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end .row -->
            </div>
        </div>
    </div>
@stop
