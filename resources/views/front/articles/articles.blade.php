@extends('front.layout')
@section('title') Actualités - {{config('application.name')}} @stop
@section('header')
    <div class="header-search fixed-height">
        @include('front.inc.search')

        <div class="page-heading blog-list-heading">
            <span></span> <!-- for dark-overlay on the bg -->

            <div class="container">

                <h1>Actualités {{$titre}}</h1>

                <div class="heading-link">
                    <a href="{{url('/')}}" title="Page d'accueil {{ config('application.name')}}">Accueil</a>

                    <i>/</i>

                      <a href="{{ url('actualites') }}" title="Actualités entreprises africaines">Actualités</a>
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
                                    <div class="row clearfix">
                                        @foreach($articles as $article)
                                            <div class="col-md-12">

                                                <div class="single-product">
                                                    @if(!empty($article->image))
                                                        <figure>
                                                            <img src="{{$article->imagelink}}" alt="{{ $article->titre}}">
                                                        </figure>
                                                    @endif

                                                    <h4>
                                                        <a href="{{$article->link}}" title="{{ $article->titre}}">{{ $article->titre}}</a>
                                                    </h4>

                                                    <h5>
                                                        <a href="{{ url('actualites/'.$article->section->slug)}}" title="{{$article->section->section}}">{{$article->section->section}}</a>
                                                    </h5>

                                                    <p>{{ str_limit(strip_tags($article->contenu),150)}}.</p>

                                                    <a class="read-more" href="{{$article->link}}" title="En savoir plus sur {{ $article->titre}} "><i class="fa fa-angle-right"></i>Lire</a>

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
                        <div class="blog-list-pagination">
                            {!! $articles->render() !!}
                        </div>

                    </div>
                    <!-- end .grid-layout -->

                    <div class="col-md-4">
                       @include('front.articles.sidebar')
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
