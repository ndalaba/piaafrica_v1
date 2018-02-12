@extends('front.layout')
@section('header')
    <div class="header-search fixed-height">
        @include('front.inc.search')
        <div class="page-heading blog-list-heading">
            <span></span> <!-- for dark-overlay on the bg -->
            <div class="container">
                <h1> CONDITIONS GÉNÉRALES D'UTILISATION </h1>

                <div class="heading-link">
                    <a href="{{url('/')}}" title="Page d'accueil de {{config('application.name')}}">Accueil</a>

                    <i>/</i>

                    <a href="{{ url('regles-generales') }}" title="Conditions générales d'utilisation">Conditions générales</a>
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

                    <h3>Piaafrica.com est un annuaire destiné à mettre en relation les entreprises au travers d'offres de référencement gratuites et payantes.</h3>

                    <p><strong> Éditeur </strong><br/>

                        Piaafrica.com est un service privé distinct du Registre national du commerce et des sociétés et est édité par Guinee-Webdev, A1-A2 WAQF BID Guinée
                        Kaloun - Conakry. Toutes les informations sont données à titre indicatif.</p>

                    <p><strong>Consultation </strong><br/>

                        La consultation ou la réception de documents n'entraîne aucun transfert de droit de propriété intellectuelle en faveur de l'utilisateur. Ce dernier s'engage à ne pas rediffuser ou reproduire les données fournies autrement que pour son usage personnel. Les données transmises sont traitées en conformité avec les usages en vigueur. L'éditeur fournit l'information et les services associés en l'état et ne saurait accorder une garantie quelconque notamment pour la fiabilité, l'actualité ou l'exhaustivité des données. L'utilisateur recherche, sélectionne et interprète les données sous sa propre responsabilité.
                    </p>

                    <p><strong> Conditions d'utilisation </strong><br/>

                        Les données contenues sur le site sont protégées par la loi du 1er juillet 1998 sur les bases de données.

                        En accédant ou en utilisant le site, vous reconnaissez vous conformer aux dispositions de la loi, et notamment en vous interdisant l'extraction, le transfert, le stockage, la reproduction de tout ou partie qualitativement ou quantativement substantielle du contenu des bases de données figurant sur le site.

                        La reproduction, la rediffusion ou l'extraction automatique par tout moyen d'informations figurant sur piaafrica.com est interdite. L'emploi de robots, programmes permettant l'extraction directe de données est de même rigoureusement interdit.

                        PIA AFRICA se réserve le droit d'entamer toute action visant à faire cesser le préjudice.</p>

                    <p><strong> Confidentialité </strong> <br/>

                        Piaafrica.com n'enregistre pas d'informations personnelles permettant l'identification, à l'exception des formulaires que l'utilisateur est libre de remplir (ouverture de compte, adhésion volontaire à une liste de diffusion, correction d'une fiche...). Piaafrica.com, ou ses mandants, se réservent le droit de contacter toute personne ayant volontairement donné ses coordonnées au sujet d'opérations ou de promotions sur le site.

                        Piaafrica.com pourra procéder à des analyses statistiques sans que celles-ci soient nominatives et pourra en informer des tiers (organismes d'évaluation de fréquentation) sous une forme résumée et non nominative.
                    </p>

                    <p><strong>Cookies </strong>

                        La gestion des profils nécessite l'utilisation de cookies. Des informations non personnelles sont enregistrées par ce système de cookies (fichiers texte utilisés pour reconnaître un utilisateur et ainsi faciliter son utilisation du site). Ceux-ci n'ont aucune signification en dehors de leur utilisation sur le site Piaafrica.com.


                </div>
            </div>
        </div>
    </div>

@stop
