@extends('front.layout')
@section('title') Mot de passe oublié? - @parent @stop
@section('description')Envie de vendre, louer un bien personnel ? Déposer votre annonce gratuitement sur maakiti.com, le plus grand site de petites annonces dans votre région ! - @parent @stop
@section('content')

    <section id="page-head">
        <div class="container">
            <div class="row col-md-12">
                <div class="page-heading">
                    <h1>Mot de passe oublié?</h1>
                </div>
            </div>
        </div>
    </section>
    <section id="formSubmit">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
                    <div class="user-form">
                        <div class="user-form-set">
                            <h4>Mot de passe oublié?</h4>
                            @if (isset($error))
                                <div class="alert alert-danger">
                                    <p class="message"> {{ $error }}.<br></p>
                                </div>
                            @endif
                            @if (isset($succes))
                                <div class="alert alert-success">
                                    <p class="message"> {{ $succes }}.<br></p>
                                </div>
                            @endif
                            <strong>Indiquez votre email et validez pour réinitialiser votre mot de passe</strong>

                            <form method="post" class="form-group" action="{{ url('reset-passeword') }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <div class="form-input">
                                    <span class="fa fa-envelope form-control-feedback"></span>
                                    <input class="form-control" type="text" name="email" value="{{ old('email') }}" placeholder="Adresse email" autocomplete="off">
                                </div>

                                <div class="form-input">
                                    <input type="submit" name="login" value="Recevoir un email de réinitialisation">
                                </div>
                                <div class="form-input">
                                    <p><a href="{{ url('se-connecter') }}">Retour à la connexion</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
