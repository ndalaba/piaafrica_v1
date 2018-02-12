@extends('front.layout')
@section('title') @parent | Compte professionel @stop
@section('description')La création d'un compte professionel est gratuite et obligatoire pour disposer de plus de trois annonces sur le site. - @parent @stop
@section('content')

<section id="page-head">
    <div class="container">
        <div class="row col-md-12">
            <div class="page-heading">
                <h1> Compte professionel</h1>
            </div>
        </div>
    </div>
</section>
        <!--Category-->
<section id="detail">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="page-content">
                  <h4 class="inner-heading">La création d'un Compte Pro est gratuite et obligatoire pour disposer de plus de trois annonces sur le site.</h4>
                  <p>Ce service vous permet de déposer plus simplement et rapidement vos annonces et d'améliorer leur gestion.</p>
                  <p>⇒ Diffusez automatiquement vos annonces !</p>
                  <p>⇒ Vous disposez d'un tableau de bord pour piloter l'ensemble de vos annonces en ligne</p>
                  <p>⇒ Une validation prioritaire et une mise en ligne plus rapide de vos annonces,</p>
                  <p>⇒ L'insertion de photos supplémentaires pour une meilleure valorisation de votre annonce</p>
                  <p>⇒ Présenter votre entreprise et son savoir-faire à vos clients potentiels ?</p>
                  <p>⇒ Regrouper toutes vos annonces sur une page personnalisée et multiplier vos chances de vendre ?</p>

                </div>
            </div>
            @include('front.inc.sidebar')
        </div>
    </div>
</section><!--end advertisement-->
  @include('front.inc.largepub')
@stop
