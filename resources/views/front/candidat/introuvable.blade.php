@extends('front.layout')
@section('header')
    <div class="header-search fixed-height">
        @include('front.candidat.search')

        <div class="page-heading blog-list-heading">
            <span></span> <!-- for dark-overlay on the bg -->

            <div class="container">

                <h1>CV  introuvable</h1>

                <div class="heading-link">
                    <a href="{{url('/')}}" title="Page d'accueil {{config('application.name')}}">Accueil</a>

                    <i>/</i>

                    <a href="{{ url('cvtheques') }}" title="Notre cvthèques">CVThèques</a>
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
                                            <p> Le cv a été supprimer ou n'est plus visible.</p>

                                            <p> Merci de votre confiance et à très bientôt sur {{ config('application.name') }} </p>

                                            <a href="{{ url('cvtheques') }}" title="Offre d'emploi en Afrique" class="btn btn-default">Retour à la page CVThèques</a>
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
                                    <li class="{{ Request::is("emploi/toutes-les-categories") ? 'active' : '' }}">
                                        <a href="{{ url('emploi/toutes-les-categories') }}" title="Offre d'emploi en Afrique"><i class="fa fa-star-o"></i>Toutes les catégories</a>
                                    </li>
                                    @foreach($sections as $s)
                                        <li class="{{ Request::is("emploi/".$s->slug) ? 'active' : '' }}">
                                            <a href="{{ url('emploi/'.$s->slug) }}" title="Offre d'emploi en Afrique - {{ $s->section }} "><i class="fa {{$s->faimage}}"></i>{{ $s->section }}
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
