@extends('front.layout')
@section('title') Accéder à votre compte  - @parent @stop
@section('header')
    <div class="header-search fixed-height">
        @include('front.inc.search')

        <div class="page-heading blog-list-heading">
            <span></span> <!-- for dark-overlay on the bg -->

            <div class="container">

                <h1>Mot de passe oublié</h1>

                <div class="heading-link">
                    <a href="{{url('/')}}" title="Page d'accueil {{ config('application.name')}}">Accueil</a>

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
            <div class="page-content">
                <div class="contact-us">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="contact-form">
                                <h3>Mot de passe oublié?</h3>
                                @if (isset($error))
                                    <div class="alert alert-danger">
                                        <p class="message" style="color: #EA4645;font-weight: bold;text-align: center;"> {{ $error }}.<br>
                                        </p>
                                    </div>
                                @endif
                                @if (isset($succes))
                                    <div class="alert alert-success">
                                        <p class="message"  style="color:  #5F7A1B;font-weight: bold;text-align: center;"> {{ $succes }}.<br></p>
                                    </div>
                                @endif
                                <strong>Indiquez votre email et validez pour réinitialiser votre mot de passe</strong>

                                <form method="post" class="form-group" action="{{ url('reset-passeword') }}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                    <div class="form-input">
                                        <input class="form-control" type="text" name="email" value="{{ old('email') }}" placeholder="Adresse email" autocomplete="off">
                                    </div>

                                    <div class="form-input">
                                        <input type="submit" name="login" value="Recevoir un email de réinitialisation" class="btn btn-default" style="width: 30%">
                                    </div>
                                    <div class="form-input">
                                        <p><a href="{{ url('se-connecter') }}" style="font-weight: bold;color: #3ab795;margin-top: 10px;display: inline-block;margin-left: 20px;">Retour à la connexion</a></p>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
