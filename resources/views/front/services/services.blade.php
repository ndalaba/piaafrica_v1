@extends('front.layout')
@section('title') Services de {{ config('application.name') }} - L'agence web de l'Afrique moderne: Conception, web design et création de sites internet, E-commerce, Hébergement, référencement, portails et applications. Nous sommes basé à Conakry, Guinée, Afrique de l'Ouest.@stop
@section('description') L'agence web de l'Afrique moderne, {{ config('application.name') }} offre des services de conception, web design, création et développement de sites internet, création de site web, cd-rom intéractif, CMS, SMS/MMS, référencement et positionnement moteurs de recherche google, portails et applications informatiques diverses. Nous sommes basé à Conakry, Guinée, Afrique de l'Ouest. @stop
@section('header')
    <div class="header-search fixed-height">
        @include('front.inc.search')

        <div class="page-heading contact-us-heading">
            <span></span> <!-- for dark-overlay on the bg -->

            <div class="container">
                <h1>Les services de <span> {{ config('application.name') }}</span></h1>

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
                                        <h3> {{ config('application.name') }} <span>Ce que nous savons faire</span></h3>
                                        @foreach($services as $s)
                                        <div class="col-md-6">
                                            <div class="single-product">
                                                <figure>
                                                    <a  href="{{url('service/'.$s->slug)}}" title="{{ $s->service }}"> <img src="{{$s->imagelink}}" alt="{{$s->service}}"></a>
                                                </figure>

                                                <h4>
                                                    <a href="{{url('service/'.$s->slug)}}" title="{{ $s->service }}">{{ $s->service }}</a>
                                                </h4>

                                                <p>{{ str_limit(strip_tags($s->description),150) }}</p>

                                                <!--<a class="read-more" href="{{url('service/'.$s->slug)}}"><i class="fa fa-angle-right"></i>En savoir plus</a>-->

                                            </div>
                                            <!-- end .single-product -->
                                        </div>
                                        @endforeach
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
