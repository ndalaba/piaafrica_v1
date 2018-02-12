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
        </div>
        <!-- end .container -->
    </div>

    @include('front.inc.featured')

    <div class="container">
      <div class="col-md-12 articles">
          @include('front.inc.articles')
      </div>
    </div>

    @include('front.inc.partenaires')

@stop
