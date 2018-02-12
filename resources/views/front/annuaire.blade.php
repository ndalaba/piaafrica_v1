@extends('front.layout')
@section('title') {{ config('application.name') }}, adresses et numéros de téléphone des professionnels et entreprises  d'Afrique @stop
@section('description') {{config('application.name') }}, service gratuit d'information sur les entreprises. Annuaire de référence des professionnels. les professionnels sont sur piaafrica.com et vous donnent leurs informations commerciales et pratiques. @stop
@section('header')
    <div class="header-search fixed-height">
        @include('front.inc.search')

        <div class="page-heading contact-us-heading">
            <span></span> <!-- for dark-overlay on the bg -->

            <div class="container">
                <h1>Annuaire des <span> sociétés, institutions, organisations...</span></h1>

                <div class="heading-link">
                  <a href="{{url('/')}}" title="Page d'accueil de {{config('application.name')}}">Accueil</a>
                    <i>/</i>
                    <a href="{{ url('annuaire') }}" title="Annuaire des entreprises africaines">Annuaire</a>
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
                <div class="contact-us">
                    <div class="row">
                        <h3>
                          <span>Annuaire des entreprises et institutions - @if(isset($country)) <a href="{{ url('recherche?q=&pays='.$country->slug.'&ville=&section=') }}">{{ $country->pays }}</a>@else Afrique @endif</span>
                            <a href="{{ url('publier-entreprise') }}" title="Ajouter une entreprise à l'annuaire" class="btn btn-default orange-circle-button">Ajouter votre <br />entreprise<br /></a>
                        </h3>
                        @foreach($annuaires as $ann)
                            <div class="col-md-3 col-sm-4 col-xs-6">
                                <div class="category-item">
                                    <a href="{{ url('entreprise/'.$ann->slug) }}" title="{{ $ann->section }}"><i class="fa  {{$ann->faimage}} fa-2x"></i>{{ $ann->section }}
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
