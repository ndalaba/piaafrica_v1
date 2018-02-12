@extends('front.layout')
@section('title') Accéder à votre compte  - @parent @stop
@section('header')
    <div class="header-search fixed-height">
        @include('front.inc.search')

        <div class="page-heading blog-list-heading">
            <span></span> <!-- for dark-overlay on the bg -->

            <div class="container">

                <h1>Compte {{ config('application.name') }} - Connexion</h1>

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
                                <h3>Connexion</h3>
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        @foreach ($errors->all() as $error)
                                            <p class="message" style="color: #EA4645;font-weight: bold;text-align: center;"> {{ $error }}.<br></p>
                                        @endforeach
                                    </div>
                                @endif

                                <form method="post" class="comment-form" action="{{ url('login') }}" >
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input class="form-control" type="text" name="email" value="{{ old('email') }}" placeholder="Adresse email" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Mot de passe</label>
                                        <input class="form-control" type="password" name="password" placeholder="mot de passe" id="password" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label for="remember">Se souvenir de moi</label>
                                        <input type="checkbox" name="remember" id="remember" style=" width: 20px;float: left;margin: 5px 5px;height: auto; margin-bottom: 20px;">

                                    </div>
                                    <div class="form-group">
                                        <input type="submit" name="login" value="login" style="width: 100%">
                                    </div>
                                    <div class="form-group">
                                        <p><a href="{{ url('reset-passeword') }}" style="color: #E93837;font-weight: bold;padding-top: 10px;display: inline-block;width: 100%;">Mot de passe oublié?</a></p>
                                    </div>
                                </form>
                                <p>Vous n'avez pas de compte ?
                                    <a href="{{url('publier-entreprise')}}" class="col" style="font-weight: bold;color: #5F7A1B;">Créer un compte</a></p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop