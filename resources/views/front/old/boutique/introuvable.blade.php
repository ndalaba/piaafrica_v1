@extends('front.layout')
@section('content')

    <section id="page-head">
        <div class="container">
            <div class="row col-md-12">
                <div class="page-heading">
                    <h1>Cette boutique est désactivée</h1>
                </div>
            </div>
        </div>
    </section>
    <!--Category-->
    <section id="detail">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-content">
                        <p><strong>Causes possibles :</strong></p> <br/>

                        <p> L'abonnement de l'annonceur à l'offre Boutique a pris fin. </p>

                        <p> La souscription à l'abonnement vient d'être activée : il faut compter un délai d'une heure avant que la Boutique ne soit visible  </p>

                        <p> Le lien sur lequel vous avez cliqué peut être sectionné. Nous vous conseillons de le vérifier.    </p>

                        <p> Merci de votre confiance et à très bientôt sur maakiti.com   </p>

                        <a href="{{ url('') }}" title="Retour à la page d'accueil" class="btn btn-info">Retour à la page d'accueil</a>

                    </div>
                    @include('front.inc.largepub')
                </div>
            </div>
        </div>
    </section><!--end advertisement-->

@stop
