@extends('front.layout')
@section('title') Enregistrer votre entreprise - @parent @stop
@section('header')
    <div class="header-search fixed-height">
        @include('front.inc.search')

        <div class="page-heading blog-list-heading">
            <span></span> <!-- for dark-overlay on the bg -->

            <div class="container">

                <h1>Inscriver votre entreprise sur {{ config('application.name') }}</h1>

                <div class="heading-link">
                    <a href="{{url('/')}}" title="Page d'accueil {{ config('application.name')}}">Accueil</a>

                    <i>/</i>

                    <a href="{{ url('publier-entreprise') }}" title="Ajouter une entreprise à l'annuaire">Inscription</a>
                </div>

            </div>
                          <!-- END .container-->
        </div>
    </div>
    <div class="header-nav-bar">
        <div class="container">
            @if(Auth::user() && Auth::user()->droit >= config('application.contact'))
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
                        @if(Auth::user() && Auth::user()->droit <= config('application.contact'))
                            <h2>Vous êtes connectés en tant que chercheur d'emloi. Vous ne pouvez donc pas publier une entreprise</h2>
                        @else
                            <div class="col-md-12">
                                <h2>En inscrivant votre entreprise à {{config('application.name')}} vous bénéficiez de:</h2>

                                <div style="width: 90%; margin:auto">
                                    <h4>Faire connaitre vos activités, vos services, produits, partenaires....</h4>
                                    <h4>Publier des informations liées à votre entreprise(news, actualités...)</h4>
                                    <h4>Publier des annonces (offres d'emploi...)</h4>
                                </div>
                                <div class="contact-form">
                                    @if(Session::has('success'))
                                        <div class="alert alert-success">
                                            <p class="fa">Entreprise publiée. </p>
                                            <a href="{{ url('mon-compte') }}" class="btn btn-sm btn-info" style="float: right"> Aller à mon compte</a>

                                        </div>
                                    @elseif(Auth::user() && !is_null($entreprise->id))
                                        <a href="{{ url('mon-compte') }}" class="btn btn-sm btn-info"><i class="fa fa-home"></i> Aller à mon compte</a>
                                        <a href="{{ url('entreprise-detail/about/'.$entreprise->id) }}" class="btn btn-primary btn-sm ajax"><i class="fa fa-pencil"></i> A propos</a>
                                        <a href="{{ url('entreprises-detail/services/'.$entreprise->id) }}" class="btn btn-primary btn-sm ajax"><i class="fa fa-tags"></i> Services</a>
                                        <a href="{{ url('entreprises-detail/produits/'.$entreprise->id) }}" class="btn btn-primary btn-sm ajax"><i class="fa fa-bars"></i> Produits/Réalisations</a>
                                        <a href="{{ url('entreprises-detail/partenaires/'.$entreprise->id) }}" class="btn btn-primary btn-sm ajax"><i class="fa fa-user"></i> Partenaires</a>
                                        <a href="{{ url('entreprises-detail/adresses/'.$entreprise->id) }}" class="btn btn-primary btn-sm ajax"><i class="fa fa-location-arrow"></i> Adresses</a>
                                    @endif
                                    @include('admin.errors')

                                    <form action="{{ url('entreprises/publier') }}" method="post" id="post" class="comment-form" enctype="multipart/form-data">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="user_id" value="{{ $entreprise->user_id }}">
                                        @if(!is_null($entreprise->id))
                                            <input type="hidden" name="id" value="{{$entreprise->id}}">
                                        @endif
                                        @if(!Auth::user())
                                            <h3>Vos informations</h3>
                                            <div class="form-group">
                                                <label for="ville">Nom</label>
                                                <input type="text" name="name" id="name" value="{{$user->name}}" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="fonction">Fonction</label>
                                                <select id="fonction" name="fonction" class="form-control" required="">
                                                    <option value=""></option>
                                                    <option value="PDG-DG-Gerant">PDG-DG-Gérant</option>
                                                    <option value="Dir/Resp Commercial">Dir/Resp Commercial</option>
                                                    <option value="Dir/Resp des Achats">Dir/Resp des Achats</option>
                                                    <option value="Dir/Resp Export">Dir/Resp Export</option>
                                                    <option value="Dir/Resp Finance-Compta-Gestion">Dir/Resp Finance-Compta-Gestion</option>
                                                    <option value="Dir/Resp Informatique">Dir/Resp Informatique</option>
                                                    <option value="Dir/Resp Juridique">Dir/Resp Juridique</option>
                                                    <option value="Dir/Resp Marketing-Communication">Dir/Resp Marketing/Communication</option>
                                                    <option value="Dir/Resp Ressources Humaines">Dir/Resp Ressources Humaines</option>
                                                    <option value="Dir/Resp Services Generaux">Dir/Resp Services Généraux</option>
                                                    <option value="Dir/Resp Technique - Production">Dir/Resp Technique/Production</option>
                                                    <option value="Dir/Resp Logistique">Dir/Resp Logistique</option>
                                                    <option value="Service Technique - Production">Service Technique / Production</option>
                                                    <option value="Service Achats">Service Achats</option>
                                                    <option value="Service Commercial">Service Commercial</option>
                                                    <option value="Service Direction Generale">Service Direction Générale</option>
                                                    <option value="Service Export">Service Export</option>
                                                    <option value="Service Finance-Compta-Gestion">Service Finance-Compta-Gestion</option>
                                                    <option value="Service Juridique">Service Juridique</option>
                                                    <option value="Service Marketing-Communication">Service Marketing/Communication</option>
                                                    <option value="Service Ressources Humaines">Service Ressources Humaines</option>
                                                    <option value="Service Generaux">Service Généraux</option>
                                                    <option value="Service Logistique">Service Logistique</option>
                                                    <option value="Service Informatique">Service Informatique</option>
                                                    <option value="Architecte - Bureau Etude">Architecte - Bureau d'étude</option>
                                                    <option value="Prof. Juridique et reglementee">Prof. Juridique et réglementée</option>
                                                    <option value="Prof. Lib-Consultant">Prof. Lib - Consultant</option>
                                                    <option value="Elu-Maire">Elu/Maire</option>
                                                    <option value="Comite Entreprise">Comité d'entreprise</option>
                                                    <option value="Autres">Autres</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="ville">Email</label>
                                                <input type="email" name="email" value="{{$user->email}}" id="email" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="pays">Phone</label>
                                                <input type="text" name="user_phone" id="user_phone" value="{{$user->phone}}" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="pays">Mot de passe</label>
                                                <input type="password" name="password" id="password" class="form-control" required>
                                            </div>

                                        @endif
                                        @if(!empty($entreprise->name))
                                            <h3>{{$entreprise->name}}</h3>
                                        @else
                                            <h3>Votre entreprise</h3>
                                        @endif

                                        <div class="form-group">
                                            <label for="titre">Entreprise</label>
                                            <input type="text" name="name" value="{{$entreprise->name}}" id="name" class="form-control" autocomplete="off">
                                            <input name="slug" type="hidden" id="slug" value="{{$entreprise->slug}}" style="font-weight: normal;font-size: 17px;width: 99%;">
                                        </div>
                                        <div class="form-group">
                                            <label for="section_id">Catégorie</label>
                                            <select name="section_id" id="section_id" required class="form-control">
                                                <option value=""></option>
                                                @foreach($sections as $section)
                                                    <option value="{{$section->id}}" @if($section->id==$entreprise->section_id)selected @endif>{{ $section->section }}</option>
                                                @endforeach
                                            </select></div>
                                        <div class="form-group">
                                            <label for="slogan">Domaine d'activité</label>
                                            <input type="text" name="domaine" value="{{$entreprise->domaine}}" id="slogan" class="form-control" autocomplete="off" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="email">email</label>
                                            <input type="email" name="email" value="{{$entreprise->email}}" id="email" class="form-control" autocomplete="off">
                                        </div>

                                        <div class="form-group">
                                            <label for="ville">Phone</label>
                                            <input type="text" name="phone" value="{{$adresse->phone}}" id="phone" class="form-control" autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <label for="web">Web</label>
                                            <input type="url" name="web" value="{{$entreprise->web}}" id="web" class="form-control" autocomplete="off" placeholder="http://www.monemtreprise.com">
                                        </div>

                                        <div class="form-group">
                                            <label for="country_id">Pays</label>
                                            <select name="country_id" id="country_id" required class="form-control">
                                                <option value=""></option>
                                                @foreach($countries as $country)
                                                    <option value="{{$country->id}}" @if($adresse->ville) @if($country->id==$adresse->ville->country_id) selected @endif @endif>{{ $country->pays }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="ville_id">Ville</label>
                                            <select name="ville_id" id="ville_id" required class="form-control">
                                                <option value=""></option>
                                                @foreach($villes as $ville)
                                                    <option value="{{$ville->id}}" @if($ville->id==$adresse->ville_id) selected @endif>{{ $ville->ville }}</option>
                                                @endforeach
                                            </select>
                                            <input type="text" id="ville" class="form-control" style="display: none" name="ville">
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Adresse</label>
                                            <textarea name="adresse" id="adresse" class="form-control" style="height: 60px">{{$adresse->adresse}}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Map:
                                                <span style="color:#f4645f">ex: 9.514259,-13.710681</span></label>
                                            <input type="text" name="map" id="map" class="form-control" placeholder="9.514259,-13.710681" value="{{$entreprise->map}}"/>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="logo">Logo entreprise:
                                                    <p class="help-block">'png', 'gif', 'jpg', 'jpeg'</p></label>
                                                <input type="file" name="fichier" value="logo" title="logo" id="fichier">
                                                <input type="hidden" name="logo" value="{{$entreprise->logo}}" title="logo" id="logo">
                                                @if(!empty($entreprise->name))
                                                    <img src="{{$entreprise->imagelink}}" style="max-width: 100%;margin: 5px;" title="logo"/>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fichierimage">Image entreprise grand format max 800K (1440x590)
                                                    <p class="help-block">'png', 'gif', 'jpg', 'jpeg'</p></label>
                                                <input type="file" name="fichierimage" value="fichierimage" title="fichierimage" id="fichierimage">
                                                <input type="hidden" name="image" value="{{$entreprise->image}}" title="image">
                                                @if(!empty($entreprise->name))
                                                    <img src="{{$entreprise->principaleImagelink}}" style="max-width: 100%;margin: 5px;" title="grande image"/>
                                                @endif

                                                <input type="checkbox" name="publie" id="in-category-1" @if($entreprise->publie) checked @endif style="display:none">
                                            </div>
                                        </div>
                                        <button type="submit" value="Enregistrer" class="btn btn-default" style="width: 100%">
                                            <i class="fa fa-save"></i>
                                            Enregistrer
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
