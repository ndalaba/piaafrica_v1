@extends('front.layout')
@section('content')

<section id="page-head">
    <div class="container">
        <div class="row col-md-12">
            <div class="page-heading">
                <h1>Qui sommes nous?</h1>
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
                    <h4 class="inner-heading">Maakiti.com - Qui sommes nous?</h4>
                        <p>
                            Maakiti.com part d'une idée simple : la bonne affaire est au coin de la rue !
                            Simple, rapide et efficace; vous y trouvez tout ce que vous cherchez.
                        </p>

                        <p>Le site Maakiti.com, une expertise  en
                            matière de petites annonces près de chez vous et à travers toute la
                            Région !</p>

                        <p>Maakiti.com est une propriété de Guinee-Webdev une société de droit guinéen spécialisée dans la création de site internet et le developpement logiciel</p>

                        <h4 class="inner-heading">Le site Maakiti.com, pour vendre et acheter toutes sortes de biens !</h4>
                        <p>Véhicule, Immobilier, Horlogerie et Bijouterie, Habillement et Mode,High-Tech, Maison et Accessoires..., il y a toujours une rubrique qui correspond au bien que vous souhaitez mettre en vente

                                Vous êtes sûr de pouvoir passer une petite annonce dans une
                                rubrique appropriée. <br>De même, Maakiti.com vous permet de rechercher tous types de bien </p>

                        <h4 class="inner-heading">Un site conçu par des professionnels pour les professionnels et les particuliers</h4>
                        <p>Toutes
                            les annonces publiées  sur le site Internet
                            Maakiti.com sont relues et validées par nos équipes avant d'être
                            publiées. Les annonces des professionnels sont également contrôlées
                            chaque semaine.</p>

                        <p>Un site mis à jour en
                            permanence, un très grand nombre d'annonces, pour attirer un maximum
                            d'acheteurs potentiels !</p>
                        <p>Nous mettons en ligne de nouvelles
                            annonces chaque jour. Chaque annonce
                            publiée reste en ligne durant 60 jours. <br>
                            Ainsi, chaque mois, des milliers d'acheteurs potentiels viennent visiter le site Maakiti.com !</p>

                        <h4 class="inner-heading">Une recherche simple et efficace</h4>
                        <p>Maakiti.com
                            facilite votre recherche de bonnes affaires ! Trouvez rapidement le
                            bien le plus proche de chez vous en effectuant une recherche par ville ou par pays.  Vous pouvez également faire une recherche rapide en tapant
                            un mot clé dans le moteur de recherche des pages de résultats.</p>
                        <br>
                        <p>Pour plus d'informations, vous pouvez eacutegalement consulter notre <a href="{{ url('faq') }}" class="col">aide</a> ou nous envoyer votre demande par <a class="col" href="{{ url('nous-contacter') }}l">email</a>.</p>
                        <br>
                        <br>
                        A bientôt sur Maakiti.com
                </div>
            </div>
            @include('front.inc.sidebar')
        </div>
    </div>
</section><!--end advertisement-->
  @include('front.inc.largepub')
@stop
