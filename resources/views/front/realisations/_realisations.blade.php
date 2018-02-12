@extends('front.layout')
@section('title') realisations de {{ config('application.name') }} - L'agence web de l'Afrique moderne: Conception, web design et création de sites internet, E-commerce, Hébergement, référencement, portails et applications. Nous sommes basé à Conakry, Guinée, Afrique de l'Ouest.@stop
@section('description') L'agence web de l'Afrique moderne, {{ config('application.name') }} offre des realisations de conception, web design, création et développement de sites internet, création de site web, cd-rom intéractif, CMS, SMS/MMS, référencement et positionnement moteurs de recherche google, portails et applications informatiques diverses. Nous sommes basé à Conakry, Guinée, Afrique de l'Ouest. @stop
@section('header')
    <div class="header-search fixed-height">
        @include('front.inc.search')

        <div class="page-heading contact-us-heading">
            <span></span> <!-- for dark-overlay on the bg -->

            <div class="container">
                <h1>Les realisations de <span> {{ config('application.name') }}</span></h1>

                <div class="heading-link">
                    <a href="{{ url('/') }}">Accueil</a>
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
                                        <h3> {{ config('application.name') }} <span>Portfolio de nos réalisations</span>
                                        </h3>

                                        <div id="filters" class="button-group">
                                            <button class="btn btn-primary" data-filter="*">Toutes</button>
                                            @foreach($services as $service)
                                                <button class="btn btn-primary" data-filter=".{{$service->slug}}">{{ $service->service }}</button>
                                            @endforeach

                                        </div>

                                        <div class="container-fluid no-gutter">

                                            <div id="posts" class="row">
                                                @foreach($realisations as $s)
                                                    <div id="1" class="item web col-md-4">
                                                        <div class="item-wrap">
                                                            <img class="img-responsive" src="{{$s->imagelink}}" alt="{{$s->realisation}}">
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
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
@section('script')

    @parent
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.isotope/1.5.25/jquery.isotope.min.js"></script>

    <script>
        $(document).ready(function () {
            /* activate jquery isotope */
            var $container = $('#posts').isotope({
                itemSelector: '.item',
                isFitWidth: true
            });

            $(window).smartresize(function () {
                $container.isotope({
                    columnWidth: '.col-md-6'
                });
            });

            $container.isotope({filter: '*'});

            // filter items on button click
            $('#filters').on('click', 'button', function () {
                var filterValue = $(this).attr('data-filter');
                $container.isotope({filter: filterValue});
            });
        });

    </script>

@endsection
