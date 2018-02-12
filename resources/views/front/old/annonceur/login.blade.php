@extends('front.layout')
@section('title') Déposer une pétite annonce - @parent @stop
@section('description')Envie de vendre, louer un bien personnel ? Déposer votre annonce gratuitement sur maakiti.com, le plus grand site de petites annonces dans votre région ! - @parent @stop
@section('content')

<section id="page-head">
    <div class="container">
        <div class="row col-md-12">
            <div class="page-heading">
                <h1>Déposer une annonce sur Maakiti.com est GRATUIT.</h1>
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
                          <h4>Connexion</h4>
                          @if (count($errors) > 0)
                             <div class="alert alert-danger">
                                 @foreach ($errors->all() as $error)
                                  <p class="message"> {{ $error }}.<br></p>
                                 @endforeach
                             </div>
                         @endif
                          <form method="post" class="form-group" action="{{ url('login') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                              <div class="form-input">
                                  <span class="fa fa-user form-control-feedback"></span>
                                  <input class="form-control" type="text" name="email" value="{{ old('email') }}" placeholder="Adresse email" autocomplete="off">
                              </div>
                              <div class="form-input">
                                  <span class="fa fa-unlock-alt form-control-feedback"></span>
                                  <input class="form-control" type="password" name="password" placeholder="Password" autocomplete="off">
                              </div>
                              <div class="form-input">
                                  <input type="checkbox" name="remember" id="remember">
                                  <label for="remember">Se souvenir de moi</label>
                              </div>
                              <div class="form-input">
                                  <input type="submit" name="login" value="login">
                              </div>
                              <div class="form-input">
                                  <p><a href="{{ url('reset-passeword') }}">Mot de passe oublié?</a></p>
                              </div>
                          </form>
                          <!--<div class="social-login">
                              <h4>LOGIN VIA SOCIAL ACCOUNT</h4>
                              <div class="social-accounts">
                                  <a href="#">
                                      <i class="fa fa-facebook"></i>
                                  </a>
                                  <a href="#">
                                      <i class="fa fa-twitter"></i>
                                  </a>
                                  <a href="#">
                                      <i class="fa fa-google-plus"></i>
                                  </a>
                              </div>
                          </div>-->
                          <p>Vous n'avez pas de compte ?  <a href="{{url('annonceur/creer-compte')}}" class="col">Créer un compte</a></p>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
@stop
