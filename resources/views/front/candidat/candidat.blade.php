@extends('front.layout')
@section('title'){{ $candidat->name}} @if($candidat->ville)  - {{$candidat->ville->country->pays }} @endif @stop
@section('header')
    <div class="header-search fixed-height">
        @include('front.candidat.search')

        <div class="page-heading blog-list-heading">
            <span></span> <!-- for dark-overlay on the bg -->

            <div class="container">

                <h1>{{ $candidat->name}} @if($candidat->ville)  - {{$candidat->ville->country->pays }} @endif </h1>

                <div class="heading-link">
                    <a href="{{url('/')}}" title="Page d'accueil {{ config('application.name')}}">Accueil</a>

                    <i>/</i>

                    <a href="{{ url('cvtheques') }}" title="Notre cvthèques">CVThèques</a>
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
                        <div class="blog-list blog-post" style="border: none">
                                @if($candidat->candidat)
                                    @if($candidat->candidat->photo)
                                        <div class="col-sm-4 col-md-6">
                                            <img src="{{asset('uploads/candidats/photos/'.$candidat->candidat->photo)}}"
                                                 alt="" class="img-rounded img-responsive"/>
                                        </div>
                                    @endif
                                @endif
                                <div class="col-sm-4 col-md-4">
                                    <blockquote>
                                        <p> @if($candidat->candidat) {{$candidat->candidat->civilite}} @endif {{$candidat->name}}</p>
                                        @if($candidat->ville)
                                            <small>
                                                <cite title="Source Title">
                                                    @if($candidat->candidat)
                                                        {{$candidat->candidat->adresse}} <br>
                                                    @endif
                                                    {{ $candidat->ville->ville.' '.$candidat->ville->country->pays }}
                                                    <i class="glyphicon glyphicon-map-marker"></i></cite>
                                            </small>
                                        @endif
                                    </blockquote>
                                    <p><i class="glyphicon glyphicon-envelope"></i> {{$candidat->email}}
                                        @if($candidat->candidat)
                                            <br/> <i class="glyphicon glyphicon-globe"></i>{{$candidat->candidat->linkedin}}
                                            <br/>
                                            <i class="glyphicon glyphicon-gift"></i> {{ \App\Http\Models\Help::timestampToDate($candidat->candidat->naissance) }}
                                    </p>
                                    @endif
                                </div>
                                @if($candidat->candidat)
                                    <div class="col-sm-6 col-md-6">
                                        <blockquote>
                                            <p><strong>Profession</strong> {{$candidat->fonction}}</p>
                                            <p><strong>Niveau de formation</strong> {{$candidat->candidat->niveau}}</p>
                                            <p><strong>Première langue</strong> {{$candidat->candidat->langue}}</p>
                                            <p><strong>Deuxième langue</strong> {{$candidat->candidat->languebis}}</p>
                                            <p><strong>Spécialité</strong> {{$candidat->candidat->specialite}}</p>
                                            <p><strong>Année d'expérience</strong> {{$candidat->candidat->experience}}</p>
                                            <p><strong>Profil linkedIn</strong> <a href="{{$candidat->candidat->linkedin}}" style="color: #3ab795">{{$candidat->candidat->linkedin}}</a></p>
                                            <p>
                                                <a href="{{asset('uploads/candidats/cv/'.$candidat->candidat->cvdoc)}}" style="color: #3ab795">{{$candidat->candidat->cvdoc}}</a>
                                            </p>
                                        </blockquote>

                                    </div>
                                @endif
                                @if($candidat->candidat)
                                    <div>   {!!  $candidat->candidat->cv !!}</div>
                                @endif
                            <!-- end .post-with-image -->
                        </div>
                        <!-- end .blog-post -->

                    </div>

                    <div class="col-md-4">
                        @include('front.candidat.sidebar')
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
