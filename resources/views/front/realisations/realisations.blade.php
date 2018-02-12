@extends('front.layout')
@section('header')
    <div class="header-search slider-home">
        @include('front.inc.search')
        <div class="slider-content">

            <div id="home-slider" class="owl-carousel owl-theme">
                @foreach($realisations as $s)
                <div class="item">
                    <img src="{{$s->imagelink}}" alt="{{$s->realisation}}">

                    <div class="slide-content">
                        <a href="{{ $s->url }}" target="_blank" title="{{$s->realisation}}"><img src="{{$s->imagelink}}" alt="{{$s->realisation}}" style="width:200px"></a>

                        <!--<h1><a href="{{$s->url}}">{{$s->realisation}}</a></h1>-->

                    </div>
                </div>
                @endforeach
            </div>

            <div class="customNavigation">
                <a class="btn prev"><i class="fa fa-angle-left"></i></a>
                <a class="btn next"><i class="fa fa-angle-right"></i></a>
            </div>

        </div>

        <div class="container">
            <div class="header-nav-bar home-slide">
                    @include('front.inc.menu')
            </div>
            <!-- end .header-nav-bar -->
        </div>
    </div>
    <style>
        #footer{display: none} .slider-content{overflow: hidden;height: 680px;} #header {position: relative;background-color: #FFFFFF; }
        .slider-content #home-slider .item > img{width: 100%; height: auto}
        #header .header-nav-bar { position: relative; border-bottom: 3px solid #FFFFFF}
        .slider-content .customNavigation .btn.prev{position:absolute;top: 50%;left:-2px;}.slider-content .customNavigation .btn.next{position:absolute;top: 50%;right:-2px;}
    </style>
@stop