@extends('front.layout')
@section('header')
    <div class="header-search slider-home">
        @include('front.inc.search')
        @include('front.inc.slider')

        <div class="container">
            <div class="header-nav-bar home-slide">
                    @include('front.inc.menu')
            </div>
            <!-- end .header-nav-bar -->
        </div>
    </div>
@stop
@section('content')
    <div id="page-content" class="home-slider-content">
        <div class="container">
            <div class="home-with-slide">
                <div class="row" style="margin:0px">
                    <div class="col-md-12">
                        @include('front.inc.section')
                    </div>

                </div>
                <!-- end .row -->
            </div>
        <div class="col-md-12">
                @include('front.inc.articles')
            </div>
            <!-- end .home-with-slide -->
        </div>
        <!-- end .container -->
    </div>    

    @include('front.inc.featured')

    @include('front.inc.partenaires')

    <script type="application/ld+json">
    {
      "@context": "http://schema.org",
      "@type": "WebSite",
      "url": "https://www.piaafrica.com/",
      "potentialAction": {
        "@type": "SearchAction",
        "target": "http://www.piaafrica.com/recherche?q={search_term_string}&ville=&section=",
        "query-input": "required name=search_term_string"
      }
    }
    </script>

@stop
