@extends('front.layout')
@section('header')
    <div class="header-search fixed-height">
        @include('front.inc.search')

        <div class="page-heading blog-list-heading">
            <span></span> <!-- for dark-overlay on the bg -->

            <div class="container">

                <h1>Entreprise introuvable</h1>

                <div class="heading-link">
                    <a href="{{url('/')}}" title="Page d'accueil {{config('application.name')}}">Accueil</a>

                    <i>/</i>

                    <a href="{{ url('annuaire') }}" title="Annuaire entreprises africaines">Annuaire</a>
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
            <div class="row">
                <div class="col-md-9 col-md-push-3">
                    <div class="page-content">
                        <div class="view-switch product-details-list">
                            <div class="tab-content">
                                <div class="tab-pane active">
                                    <h2>Causes possibles </h2>

                                    <div class="row clearfix">
                                        <div class="col-sm-4 col-xs-6">
                                            <p> L'entreprise a été  supprimée ou n'existe plus </p>

                                            <p> Si vous venez de recevoir l'email de validation de votre inscription, il faut compter un délai d'une demi-heure avant qu'elle ne soit visible sur le site. </p>

                                            <p> Le lien sur lequel vous avez cliqué peut être sectionné. Nous vous conseillons de le vérifier. </p>

                                            <p> Merci de votre confiance et à très bientôt sur {{ config('application.name') }} </p>

                                            <a href="{{ url('annuaire') }}" title="Annuaire entreprises africaines" class="btn btn-default">Retour à la page d'annuaire</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- end .tabe-content -->

                           @include('front.inc.pub-add')

                        </div>
                        <!-- end .product-details -->
                    </div>
                    <!-- end .page-content -->
                </div>
                <div class="col-md-3 col-md-pull-9 category-toggle">
                    <button><i class="fa fa-briefcase"></i></button>
                    <div class="page-sidebar">
                        <div id="categories">
                            <div class="accordion">
                                <ul class="nav nav-tabs accordion-tab" role="tablist">
                                    <li class="{{ Request::is("annuaire/toutes-les-categories") ? 'active' : '' }}">
                                        <a href="{{ url('annuaire/toutes-les-categories') }}" title="Annuaire entreprises africaines"><i class="fa fa-star-o"></i>Toutes les catégories</a>
                                    </li>
                                    @foreach($sections as $s)
                                        <li class="{{ Request::is("annuaire/".$s->slug) ? 'active' : '' }}">
                                            <a href="{{ url('annuaire/'.$s->slug) }}" title="Annuaire entreprises africaines - {{ $s->section }} "><i class="fa {{$s->faimage}}"></i>{{ $s->section }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
