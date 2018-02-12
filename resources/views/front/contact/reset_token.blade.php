@extends('front.layout')
@section('title') Accéder à votre compte  - @parent @stop
@section('header')
    <div class="header-search fixed-height">
        @include('front.inc.search')

        <div class="page-heading blog-list-heading">
            <span></span> <!-- for dark-overlay on the bg -->

            <div class="container">

                <h1>Réinitialisation mot de passe</h1>

                <div class="heading-link">
                    <a href="{{url('/')}}">Accueil</a>

                    <i>/</i>

                    <a href="{{ url('publier-entreprise') }}">Inscription</a>
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
                                <h3>Réinitialiser mot de passe</h3>
                                @if (isset($error))
                                    <div class="alert alert-danger">
                                        <p class="message" style="color: #EA4645;font-weight: bold;text-align: center;"> {{ $error }}.<br>
                                        </p>
                                    </div>
                                @endif

                                <strong>Mot de passe</strong>

                                <form method="post" class="form-group" action="{{ url('inquire/password/edit') }}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="reset_password_token" value="{{ $reset_password_token }}">
                                    <input type="hidden" name="email" value="{{$email }}">

                                    <div class="form-input">
                                        <input class="form-control" type="password" name="password" autocomplete="off">
                                    </div>

                                    <div class="form-input">
                                        <input type="submit" name="login" value="Valider le nouveau mot de passe" class="btn btn-default" style="width: 30%">
                                    </div>
                                    <div class="form-input">
                                        <p>
                                            <a href="{{ url('se-connecter') }}" style="font-weight: bold;color: #5F7A1B;margin-top: 10px;display: inline-block;margin-left: 20px;">Retour à la connexion</a>
                                        </p>
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