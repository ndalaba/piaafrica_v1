<div class="col-md-4">
    <div class="sidebar">
        <!--advertisement-->
        <div class="side-widget">
            <h4 class="inner-heading">PUBLICITÉ</h4>
            @include('front.inc.sidepub')
        </div>
        <!--end advertisement widget-->
        <div class="side-widget clearfix">
            <h4 class="inner-heading">LA BOUTIQUE PREMIUM</h4>
                <p><strong class="uppercase">Améliorez la visibilité de votre entreprise et de vos annonces</strong></p>
                <ul>
                    <li>Affichez votre logo sur chacune de vos annonces.</li>
                    <li>Bénéficiez d'une page vitrine sur maakiti.com pour présenter votre entreprise (horaires, localisation, site web, savoir-faire...).</li>
                    <li>Regroupez sur une même page toutes vos annonces liées à votre activité.</li>
                </ul>
                <a href="{{ url('boutique/creer-compte') }}" class="btn btn-danger" style="width: 70%; margin: 10px"> Créer ma boutique</a>
        </div>
    </div>
</div>