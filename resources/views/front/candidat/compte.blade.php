@extends('front.layout')
@section('title') Compte {{ config('application.name') }} de {{ \Auth::user()->name }} - @parent @stop
@section('header')
    <div class="header-search fixed-height">
        @include('front.annonce.search')

        <div class="page-heading blog-list-heading">
            <span></span> <!-- for dark-overlay on the bg -->

            <div class="container">

                <h1>Bonjour {{ \Auth::user()->name }}</h1>

                <div class="heading-link">
                    <a href="{{url('/')}}" title="Page d'accueil {{config('application.name')}}">Accueil</a>
                </div>

            </div>
                          <!-- END .container-->
        </div>
    </div>
    <div class="header-nav-bar">
        <div class="container">
            @include('front.candidat.menu')
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
                        <div class="container">
                            <div class="row">
                                @if($user->candidat)
                                    @if($user->candidat->photo)
                                        <div class="col-sm-2 col-md-2">
                                            <img src="{{asset('uploads/candidats/photos/'.$user->candidat->photo)}}"
                                                 alt="" class="img-rounded img-responsive"/>
                                        </div>
                                    @endif
                                @endif
                                <div class="col-sm-4 col-md-4">
                                    <blockquote>
                                        <p> @if($user->candidat) {{$user->candidat->civilite}} @endif {{$user->name}}</p>
                                        @if($user->ville)
                                            <small>
                                                <cite title="Source Title">
                                                    @if($user->candidat)
                                                        {{$user->candidat->adresse}} <br>
                                                    @endif
                                                    {{ $user->ville->ville.' '.$user->ville->country->pays }}
                                                    <i class="glyphicon glyphicon-map-marker"></i></cite>
                                            </small>
                                        @endif
                                    </blockquote>
                                    <p><i class="glyphicon glyphicon-envelope"></i> {{$user->email}}
                                        @if($user->candidat)
                                            <br/> <i class="glyphicon glyphicon-globe"></i>{{$user->candidat->linkedin}}
                                            <br/>
                                            <i class="glyphicon glyphicon-gift"></i> {{ \App\Http\Models\Help::timestampToDate($user->candidat->naissance) }}
                                            <br/>
                                            {!! $user->candidat->etat !!}
                                    @endif
                                    </p>
                                </div>
                                @if($user->candidat)
                                    <div class="col-sm-6 col-md-6">
                                        <blockquote>
                                            <p><strong>Profession</strong> {{$user->fonction}}</p>
                                            <p><strong>Niveau de formation</strong> {{$user->candidat->niveau}}</p>
                                            <p><strong>Première langue</strong> {{$user->candidat->langue}}</p>
                                            <p><strong>Deuxième langue</strong> {{$user->candidat->languebis}}</p>
                                            <p><strong>Spécialité</strong> {{$user->candidat->specialite}}</p>
                                            <p><strong>Année d'expérience</strong> {{$user->candidat->experience}}</p>
                                            <p><strong>Profil linkedIn</strong> <a href="{{$user->candidat->linkedin}}" style="color: #3ab795">{{$user->candidat->linkedin}}</a></p>
                                            <p>
                                                <a href="{{asset('uploads/candidats/cv/'.$user->candidat->cvdoc)}}" style="color: #3ab795">{{$user->candidat->cvdoc}}</a>
                                            </p>
                                        </blockquote>

                                    </div>
                                @endif
                                @if($user->candidat)
                                    <div style="float: left;">   {!!  $user->candidat->cv !!}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end .row -->
            </div>
            <!-- end .page-content -->
        </div>
        <!-- end .container -->
    </div>
@stop
