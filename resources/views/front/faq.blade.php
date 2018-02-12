@extends('front.layout')
@section('header')
    <div class="header-search fixed-height">
        @include('front.inc.search')
        <div class="page-heading blog-list-heading">
            <span></span> <!-- for dark-overlay on the bg -->
            <div class="container">
                <h1>FOIRE AUX QUESTIONS (FAQ) </h1>

                <div class="heading-link">
                      <a href="{{url('/')}}" title="Page d'accueil de {{config('application.name')}}">Accueil</a>

                    <i>/</i>

                    <a href="{{ url('faq') }}" title="Foire à question">FAQ</a>
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
                    <p><strong>Qui peut s'inscrire sur piaafrica.com ? </strong><br/>

                        Toutes les entreprises référencées au Registre du Commerce sont éligibles pour une inscription. Recherchez votre société et commencez l'inscription en
                        <a href="{{ url('publier-entreprise') }}" title="Ajouter une entreprise à l'annuaire">cliquant ici !</a>
                    </p>

                    <p><strong>L'inscription est-elle payante ?</strong><br/>

                        Non ! Vous pouvez inscrire votre entreprise et renseigner sa fiche gratuitement. Une fois validée, celle-ci sera immédiatement consultable par les internautes sur Piaafrica.com. Une fois inscrite, les modifications sur votre fiche entreprise sont gratuites et illimitées !
                    </p>

                    <p><strong>Je souhaite compléter ma fiche. Comment faire ?</strong><br/>

                        Rien de plus simple, il suffit de vous inscrire en
                        <a href="{{ url('publier-entreprise') }}" title="Ajouter une entreprise à l'annuaire">cliquant ici </a>, puis contactez nous avec votre email d'inscription.
                    </p>

                    <p><strong>Que va m'apporter une inscription sur Piaafrica.com ?</strong><br/>

                        En vous inscrivant sur Piaafrica.com, vous positionnez votre entreprise sur une plate-forme de passage pour les internautes qui cherchent des produits et des services. Dans les semaines qui suivent votre inscription, votre fiche Piaafrica.com remontera dans les résultats pertinents des moteurs de recherche (Google, Yahoo...). Ce mécanisme sera renforcé si vous remplissez votre fiche en détails et que vous la mettez à jour régulièrement. Vos clients potentiels pourront alors vous contacter ou se rendre sur votre site Internet via votre fiche. En vous inscrivant, vous donnez gratuitement un coup de pouce à votre activité !
                    </p>

                    <p><strong>Comment optimiser l'efficacité de ma fiche Piaafrica.com ?</strong><br/>

                        En tant qu'entreprise, votre but est d'être présent là où des clients cherchent des produits et des services que vous fournissez. Pour ce faire, il faut que votre fiche ressorte et soit visible sur Piaafrica.com. Remplissez soigneusement votre fiche en mettant un maximum d'informations sur votre entreprise et sur vos informations de contact. Rien n'est pire que de rater un client parce que celui-ci n'a pas pu trouver votre numéro de téléphone ou votre email ! Également, plus vous serez précis dans la description de votre entreprise et de ses produits et services (par l'intermédiaire de filtres par exemple) et plus les requêtes spécifiques des internautes aboutiront sur votre fiche ! Enfin, si vous voulez être mis en avant sur Piaafrica.com, nous vous invitons à prendre contact avec nous.

                    </p>

                    <p>
                        <strong>Les informations sur ma fiche ne sont pas à jour. Je souhaite les modifier mais je ne sais pas comment faire.</strong>
                        <br/>

                        Vous pouvez modifier les informations de votre fiche à tout moment en vous connectant à votre espace membre, en
                        <a href="{{ url('mon-compte') }}" title="Consulter votre compte">cliquant ici !</a>. Une fois connecté, vous pourrez changer à loisirs les champs que vous avez remplis précédemment. Les modifications sont gratuites et illimités !

                    </p>
                    Vous n'avez pas trouvé l'information que vous cherchiez ? <br/>

                    N'hésitez pas à nous contacter nous en remplissant ce formulaire <a href="{{ url('nous-contacter') }}" title="Nous contacter">contact </a>.
                </div>
            </div>
        </div>
    </div>

@stop
