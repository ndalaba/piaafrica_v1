@extends('front.layout')
@section('title') Services de {{ config('application.name') }} - {{ $service->service }}@stop
@section('description') L'agence web de l'Afrique moderne, {{ config('application.name') }} - {{ str_limit(strip_tags($service->description),150) }}@stop
@section('header')
    <div class="header-search fixed-height">
        @include('front.inc.search')

        <div class="page-heading contact-us-heading">
            <span></span> <!-- for dark-overlay on the bg -->

            <div class="container">
                <h1>{{ config('application.name') }} <span>{{ $service->service }}</span></h1>

                <div class="heading-link">
                      <a href="{{ url('/') }}" title="Page d'accueil de {{config('application.name')}}">Accueil</a>
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
                                        <h3> Nos services - <span>{{ $service->service }}</span></h3>
                                        <div class="col-md-12">
                                            <div class="single-product">
                                                <!--<figure>
                                                    <img src="{{$service->imagelink}}" alt="{{$service->service}}">
                                                </figure>-->

                                                <p>{!! $service->description !!}</p>

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
