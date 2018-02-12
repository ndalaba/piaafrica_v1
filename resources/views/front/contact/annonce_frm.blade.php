@extends('front.layout')
@section('title') Publier une offre d'emploi pour  votre annonce - @parent @stop
@section('header')
    <div class="header-search fixed-height">
        @include('front.annonce.search')

        <div class="page-heading blog-list-heading">
            <span></span> <!-- for dark-overlay on the bg -->

            <div class="container">

                <h1>Publier une offre d'emploi  sur {{ config('application.name') }}</h1>

                <div class="heading-link">
                    <a href="{{url('/')}}" title="Page d'accueil {{ config('application.name')}}">Accueil</a>

                    <i>/</i>

                </div>

            </div>
                          <!-- END .container-->
        </div>
    </div>
    <div class="header-nav-bar">
        <div class="container">
            @if(Auth::user())
                @include('front.contact.menu')
            @else
                @include('front.inc.menu')
            @endif
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
                        <div class="col-md-12">
                            <h2>En publiant votre annonce à {{config('application.name')}} vous bénéficiez de: </h2>
                         <div style="width: 90%; margin:auto">
                             <h4>Effectuer un suivi de vos offres d'emploi</h4>
                             <h4>Consulter la CVthèque</h4>
                         </div>
                            <div class="contact-form">
                                @if(Session::has('success'))
                                    <div class="alert alert-success">
                                        <p class="fa">Votre annonce a été enregistrée</p>
                                        <a href="{{$annonce->link }}" class="btn btn-sm btn-info" style="float: right"> Voir l'offre</a>
                                        <a href="{{ url('mes-offres') }}" class="btn btn-sm btn-info" style="float: right"> Afficher mes offres</a>
                                        <a href="{{ url('mes-offres/annonce') }}" class="btn btn-sm btn-info" style="float: right">Ajouter une nouvelle offre</a>
                                    </div>
                                @endif
                                @include('admin.errors')

                                <form action="{{ url('mes-offres/annonces/saveannonce') }}" method="post" id="post" class="comment-form" enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="user_id" value="{{Auth::user()->id }}">
                                    @if(!is_null($annonce->id))
                                        <input type="hidden" name="id" value="{{$annonce->id}}">
                                    @endif
                                    @if(!empty($annonce->titre))
                                        <h3>{{$annonce->titre}}</h3>
                                    @else
                                        <h3>Votre annonce</h3>
                                    @endif

                                    <div class="form-group">
                                        <label for="titre">Titre</label>
                                        <input type="text" name="titre" value="{{$annonce->titre}}" id="titre" class="form-control" autocomplete="off">
                                        <input name="slug" type="hidden" id="slug" value="{{$annonce->slug}}" style="font-weight: normal;font-size: 17px;width: 99%;">
                                    </div>
                                    <div class="form-group">
                                        <label for="entreprise_id">Entreprise annonce</label>
                                        <select name="entreprise_id" id="entreprise_id"  class="form-control">
                                            <option value=""></option>
                                            @foreach($entreprises as $entreprise)
                                                <option value="{{$entreprise->id}}" @if($entreprise->id==$annonce->entreprise_id)selected @endif>{{ $entreprise->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="section_id">Section de l'annonce</label>
                                        <select name="section_id" id="section_id" required class="form-control">
                                            <option value=""></option>
                                            @foreach($sections as $section)
                                                <option value="{{$section->id}}" @if($section->id==$annonce->section_id)selected @endif>{{ $section->section }}</option>
                                            @endforeach
                                        </select></div>
                                    <div class="form-group">
                                        <label for="type">Type d'offre d'emploi</label>
                                        <select name="type" id="type" class="form-control">
                                            <option value="">type</option>
                                            <option value="CDI" @if($annonce->type=='CDI') selected @endif>CDI</option>
                                            <option value="CDD" @if($annonce->type=='CDD') selected @endif>CDD</option>
                                            <option value="Intérim" @if($annonce->type=='Intérim') selected @endif>Intérim</option>
                                            <option value="Stage" @if($annonce->type=='Stage') selected @endif>Stage</option>
                                            <option value="Apprentissage/Alternance" @if($annonce->type=='Apprentissage/Alternance') selected @endif>Apprentissage/Alternance</option>
                                            <option value="Indépendant / Freelance / Autoentrepreneur" @if($annonce->type=='Indépendant / Freelance / Autoentrepreneur') selected @endif>Indépendant / Freelance / Autoentrepreneur</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" value="{{$annonce->email}}" id="email" class="form-control" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label for="slogan">Profil</label>
                                        <textarea name="profil" id="profil"  class="form-control">{{$annonce->profil}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="slogan">Expérience</label>
                                        <input type="text" name="experience" value="{{$annonce->experience}}" id="experience" class="form-control" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label for="slogan">Date d'expiration</label>
                                        <input type="date" name="fin" value="{{$annonce->fin}}" id="fin" class="form-control datepicker" autocomplete="off" >
                                    </div>
                                    <div class="form-group">
                                        <label for="country_id">Pays</label>
                                        <select name="country_id" id="country_id" required class="form-control">
                                            <option value=""></option>
                                            @foreach($countries as $country)
                                                <option value="{{$country->id}}" @if($annonce->ville) @if($country->id==$annonce->ville->country_id) selected @endif @endif >{{ $country->pays }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="ville_id">Ville</label>
                                        <select name="ville_id" id="ville_id" required class="form-control">
                                            <option value="">Ville</option>
                                            @foreach($villes as $ville)
                                                <option value="{{$ville->id}}" @if($ville->id==$annonce->ville_id) selected @endif>{{ $ville->ville }}</option>
                                            @endforeach
                                            <option value="0">Autre</option>
                                        </select>
                                        <input type="text" id="ville" class="form-control" style="display: none" name="ville">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">description</label>
                                        <textarea name="description" id="contenu" class="form-control" >{{$annonce->description}}</textarea>
                                    </div>
                                    <button type="submit" value="Enregistrer" class="btn btn-default" style="width: 100%">
                                        <i class="fa fa-save"></i>
                                        Enregistrer
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('script')
    @parent
    <script type="text/javascript">
        $(document).ready(function () {
            $( ".datepicker" ).datepicker({ dateFormat: 'yy-mm-dd'});
        });
    </script>
@stop
