@extends('front.layout')
@section('header')
    <div class="header-search fixed-height">
        @include('front.inc.search')
        <div class="page-heading blog-list-heading">
            <span></span> <!-- for dark-overlay on the bg -->
            <div class="container">
                <h1>QUI SOMMES-NOUS ? </h1>

                <div class="heading-link">
                    <a href="{{url('/')}}" title="Page d'accueil de {{config('application.name')}}">Accueil</a>

                    <i>/</i>

                    <a href="{{ url('qui-sommes-nous') }}" title="Connaitre {{ config('application.name')}}">Qui sommes nous?</a>
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
                <div class="about-us">
                    <h3>METTRE EN RELATION LES ENTREPRISES AU TRAVERS D'OFFRES DE RÉFÉRENCEMENT GRATUITES ET PAYANTES.</h3>

                    <p>
                        <strong>{{ config('application.name') }} vous permet de trouver à partir d'un nom, l'adresse et le numero de telephone lui  correspondant, en interrogeant notre annuaire.  </strong>
                    </p>
                    <p class="h3">Vous cherchez un médecin, un garagiste ou un bon restaurant ?
                       Vous avez besoin de faire des devis chez des professionnels ? Vous recherchez un prestataire, un fournisseur, un artisan ? </p>

                    <p>{{ config('application.name') }} vous répond. L'annuaire des professionnels vous aide à trouver à tout moment le ou les professionnels que vous recherchez.

                       Saisissez simplement l'activité du professionnel en question et complétez votre recherche en précisant où, avec un département, un code postal ou encore une ville.

                       Pour chaque réponse, vous obtiendrez les coordonnées complètes, adresse, numéros de telephone, fax…

                    </p>
                 <h3>  Acteur majeur du marché de l'emploi. </h3>
                    <p>
                        Partenaire des entreprises pour le recrutement de leurs cadres, et accompagne les jeunes diplômés à toutes les étapes de leur vie professionnelle (stage, premier emploi, évolution professionnelle...).
                    </p>
                    <p>
                       Propose une plateforme  qui donne accès aux  offres d'emplois. {{config('application.name')}} propose un moteur de recherche puissant, des alertes email gratuites et des fiches pratiques.
                    </p>
                </div>
            </div>
        </div>
    </div>

@stop
