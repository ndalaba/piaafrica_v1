@extends('front.layout')
@section('title') {{ $entreprise->name.'- '.$service->service }} @stop
@section('description') {{ str_limit(strip_tags($service->description),150) }} @stop
@section('ogtitle') {{ $entreprise->name.'- '.$service->service }} @stop
@section('ogdescription'){{ str_limit($service->description,150) }} @stop

@section('header')
    <div class="header-search fixed-height">
        @include('front.inc.search')

        <div class="page-heading blog-list-heading" @if(!empty($entreprise->principaleImage)) style="background-image: url({{asset('uploads/entreprises/images/'.$entreprise->principaleImage)}})" @endif>
            <span></span> <!-- for dark-overlay on the bg -->

            <div class="container">

                <h1>{{$entreprise->name.' - '.$service->service}}</h1>

                <div class="heading-link">
                    <a href="{{url('/')}}" title="Page d'accueil {{config('application.name')}}">Accueil</a>

                    <i>/</i>

                    <a href="{{$entreprise->link}}" title="{{$entreprise->name}}">{{$entreprise->name}}</a>
                    <i>/</i>

                    <a href="#" title="{{$entreprise->name}}">{{$service->service}}</a>
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
                        <div class="blog-list blog-post">

                            <div class="post-with-image">

                                <h2 class="title"><a href="#" title="{{$service->service}}">{{$service->service}}</a></h2>

                                <p class="user">
                                    <a href="{{$entreprise->link}}" title="{{$entreprise->name}}"><i class="fa fa-user"></i> {{$entreprise->name}}</a>
                                </p>

                                <div class="post">
                                    {!! nl2br($service->description) !!}
                                </div>
                                @include('front.inc.share')
                                <!-- end .comment-section -->

                            </div>
                            <!-- end .post-with-image -->
                        </div>
                        <!-- end .blog-post -->

                        <div class="back-to-list">
                            <a class="back-list" href="{{$entreprise->link}}" title="retour à {{$entreprise->name}}"><i class="fa fa-angle-left"></i>retour à {{$entreprise->name}}
                            </a>
                        </div>

                    </div>
                    <!-- end .grid-layout -->

                    <div class="col-md-4">
                        <div class="post-sidebar">
                            @if((count($services)>0))
                                <div class="latest-post-content">
                                    <h2>Services similaires</h2>
                                    @foreach($services as $p)
                                        <div class="latest-post clearfix">
                                            <div class="post-image">
                                                <img src="{{$p->imagelink}}" alt="{{$p->service}}">
                                            </div>

                                            <h4><a href="{{$p->link}}" title="{{$p->service}}">{{$p->service}}</a></h4>

                                            <p>{{ str_limit($p->description,50) }}.</p>

                                            <a class="read-more" href="{{$p->link}}" title="En savoir plus sur {{$p->service}}"><i class="fa fa-angle-right"></i>Détail</a>
                                        </div> <!-- end .latest-post -->
                                    @endforeach
                                </div>
                                @endif
                                        <!-- end .latest-post-content -->

                                <!-- end .post-categories -->

                               @include('front.inc.pub-square')
                                <!-- end .sqare-button -->
                                @include('front.entreprise.inc.une')

                               @include('front.inc.pub-medium')
                                <!-- end .medium-rectangle -->

                        </div>
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
