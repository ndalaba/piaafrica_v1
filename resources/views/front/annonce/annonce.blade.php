@extends('front.layout')
@section('title'){{ $annonce->titre.' '.$annonce->section->section.' -'. $annonce->ville->country->slug }}@stop
@section('description') {{ str_limit(strip_tags($annonce->description),150) }} @stop
@section('ogtitle'){{ $annonce->titre.' '.$annonce->section->section.' -'. $annonce->ville->country->slug }}@stop
@section('ogdescription') {{ str_limit(strip_tags($annonce->description),150) }} @stop
@section('header')
    <div class="header-search fixed-height">
        @include('front.annonce.search')

        <div class="page-heading blog-list-heading">
            <span></span> <!-- for dark-overlay on the bg -->

            <div class="container">

                <h1>{{ $annonce->titre }} - <span> {{ \App\Http\Models\Help::jourMois($annonce->fin,true) }}</span></h1>

                <div class="heading-link">
                    <a href="{{url('/')}}" title="Page d'accueil {{ config('application.name')}}">Accueil</a>

                    <i>/</i>

                    <a href="{{ url('emploi') }}" title="Offre d'emploi en afrique">Emploi</a>
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
                            @if (Session::has('success'))
                                <div class="alert alert-success">
                                    <p>{{Session::get('success')}}</p>
                                </div>
                            @endif

                            <div class="post-with-image">
                                <h2>
                                    @if($annonce->type)
                                    <i class="fa fa-file"></i> {{$annonce->type}}
                                    @endif
                                    <i class="fa fa-briefcase" style="margin-left: 10px"></i>
                                    <a href="{{ url('emploi/'.$annonce->section->slug) }}" title="{{ $annonce->section->section }}">{{ $annonce->section->section }}</a>
                                    <i class="fa fa-map-marker" style="margin-left: 10px"></i>  {{$annonce->ville->ville}}-{{$annonce->ville->country->pays}}
                                </h2>

                                <div class="post">

                                    @if($annonce->Entreprise)
                                        <h2><i class="fa fa-building"></i>
                                            <a href="{{$annonce->entreprise->link}}" title="{{ $annonce->entreprise->name }}" target="_blank">{{ $annonce->entreprise->name }}</a>
                                        </h2><br>
                                    @endif
                                        @if($annonce->profil)
                                        <h3><i class="fa fa-user "></i> Profil</h3><br>
                                        {!! nl2br($annonce->profil) !!}
                                        @endif
                                        <br/><br/>
                                        @include('front.inc.pub-square')
                                        <br/><br/>
                                    <h3><i class="fa fa-briefcase"></i> Poste</h3><br>
                                    {!!  nl2br($annonce->description) !!}
                                    <br><br>
                                </div>
                                @include('front.inc.share')
                                <!-- end .comment-section -->
                                <br><br>
                                @if(filter_var($annonce->email, FILTER_VALIDATE_EMAIL))
                                    @include('front.annonce.inc.postuler')
                                @endif
                            </div>
                            <!-- end .post-with-image -->
                        </div>
                        <!-- end .blog-post -->

                    </div>

                    <div class="col-md-4">
                        @include('front.annonce.sidebar')
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
