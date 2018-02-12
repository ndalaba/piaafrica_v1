@extends('front.layout')
@section('content')

    <section id="page-head">
        <div class="container">
            <div class="row col-md-12">
                <div class="page-heading">
                    <h1>Cette annonce est désactivée</h1>
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

                        <p> Le bien a déjà été vendu et l'annonceur a supprimé son annonce. </p>

                        <p> Si vous venez de recevoir l'email de validation de votre annonce, il faut compter un délai d'une demi-heure avant qu'elle ne soit visible sur le site.     </p>

                        <p> Le lien sur lequel vous avez cliqué peut être sectionné. Nous vous conseillons de le vérifier.            </p>

                        <p> Merci de votre confiance et à très bientôt sur maakiti.com   </p>

                        <a href="{{ url('') }}" title="Retour à la page d'accueil" class="btn btn-info">Retour à la page d'accueil</a>

                    </div>
                    @include('front.inc.largepub')
                </div>
            </div>
        </div>
    </section><!--end advertisement-->

@stop
