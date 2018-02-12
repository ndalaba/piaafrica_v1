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
                            <h4>Réinitialiser mot de passe</h4>
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <p class="message"> {{ $error }}.<br></p>
                                    @endforeach
                                </div>
                            @endif
                            <strong>Mot de passe</strong>
                            <form method="post" class="form-group" action="{{ url('password/edit') }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="reset_password_token" value="{{ $reset_password_token }}">
                                <input type="hidden" name="email" value="{{$email }}">

                                <div class="form-input">
                                    <span class="fa fa-user form-control-feedback"></span>
                                    <input class="form-control" type="password" name="password"  autocomplete="off">
                                </div>

                                <div class="form-input">
                                    <input type="submit" name="login" value="Valider le nouveau mot de passe">
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
