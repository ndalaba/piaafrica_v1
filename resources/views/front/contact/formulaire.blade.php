@extends('front.layout')
@section('title') Edit un compte  @parent @stop
@section('header')
    <div class="header-search fixed-height">
        @include('front.inc.search')

        <div class="page-heading blog-list-heading">
            <span></span> <!-- for dark-overlay on the bg -->

            <div class="container">

                <h1>Modifier mes informations</h1>

                <div class="heading-link">
                    <a href="{{url('/')}}">Accueil</a>

                    <i>/</i>

                    <a href="{{ url('mon -compte') }}">Compte</a>
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
                            <div class="contact-form">
                                @if(isset($success))
                                    <div class="alert alert-success">
                                        <p><span style="font-weight: bold; color: green">Compte enregistré</span>
                                            <a href="{{ url('mon-compte') }}" class="btn btn-sm btn-info" style="float: right">retour à mon compte </a>
                                        </p>
                                    </div>
                                @endif
                                @include('admin.errors')

                                <form action="{{ url('edit-info') }}" method="post" class="comment-form" enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    @if(!is_null($user->id))
                                        <input type="hidden" name="id" value="{{$user->id}}">
                                    @endif

                                    <h3 class="inner-heading">Vos informations</h3>

                                    <div class="form-group">
                                        <label for="nom">Nom</label>
                                        <input type="text" name="name" value="{{$user->name}}" id="name" class="form-control" autocomplete="off" required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="fonction">Fonction</label>
                                        <select id="fonction" name="fonction" class="form-control" required="">
                                            <option value=""></option>
                                            <option value="PDG-DG-Gerant" @if("PDG-DG-Gerant"==$user->fonction)selected @endif>PDG-DG-Gérant</option>
                                            <option value="Dir/Resp Commercial" @if("Dir/Resp Commercial"==$user->fonction)selected @endif>Dir/Resp Commercial</option>
                                            <option value="Dir/Resp des Achats" @if("PDG-DG-GerantDir/Resp des Achats"==$user->fonction)selected @endif>Dir/Resp des Achats</option>
                                            <option value="Dir/Resp Export" @if("Dir/Resp Export"==$user->fonction)selected @endif>Dir/Resp Export</option>
                                            <option value="Dir/Resp Finance-Compta-Gestion" @if("Dir/Resp Finance-Compta-Gestion"==$user->fonction)selected @endif>Dir/Resp Finance-Compta-Gestion</option>
                                            <option value="Dir/Resp Informatique" @if("Dir/Resp Informatique"==$user->fonction)selected @endif>Dir/Resp Informatique</option>
                                            <option value="Dir/Resp Juridique" @if("Dir/Resp Juridique"==$user->fonction)selected @endif>Dir/Resp Juridique</option>
                                            <option value="Dir/Resp Marketing-Communication" @if("Dir/Resp Marketing-Communication"==$user->fonction)selected @endif>Dir/Resp Marketing/Communication</option>
                                            <option value="Dir/Resp Ressources Humaines" @if("Dir/Resp Ressources Humaines"==$user->fonction)selected @endif>Dir/Resp Ressources Humaines</option>
                                            <option value="Dir/Resp Services Generaux" @if("Dir/Resp Services Generaux"==$user->fonction)selected @endif>Dir/Resp Services Généraux</option>
                                            <option value="Dir/Resp Technique - Production" @if("Dir/Resp Technique - Production"==$user->fonction)selected @endif>Dir/Resp Technique/Production</option>
                                            <option value="Dir/Resp Logistique" @if("Dir/Resp Logistique"==$user->fonction)selected @endif>Dir/Resp Logistique</option>
                                            <option value="Service Technique - Production" @if("Service Technique - Production"==$user->fonction)selected @endif>Service Technique / Production</option>
                                            <option value="Service Achats" @if("Service Achats"==$user->fonction)selected @endif>Service Achats</option>
                                            <option value="Service Commercial" @if("Service Commercial"==$user->fonction)selected @endif>Service Commercial</option>
                                            <option value="Service Direction Generale" @if("Service Direction Generale"==$user->fonction)selected @endif>Service Direction Générale</option>
                                            <option value="Service Export" @if("Service Export"==$user->fonction)selected @endif>Service Export</option>
                                            <option value="Service Finance-Compta-Gestion" @if("Service Finance-Compta-Gestion"==$user->fonction)selected @endif>Service Finance-Compta-Gestion</option>
                                            <option value="Service Juridique" @if("Service Juridique"==$user->fonction)selected @endif>Service Juridique</option>
                                            <option value="Service Marketing-Communication" @if("Service Marketing-Communication"==$user->fonction)selected @endif>Service Marketing/Communication</option>
                                            <option value="Service Ressources Humaines" @if("Service Ressources Humaines"==$user->fonction)selected @endif>Service Ressources Humaines</option>
                                            <option value="Service Generaux" @if("Service Generaux"==$user->fonction)selected @endif>Service Généraux</option>
                                            <option value="Service Logistique" @if("Service Logistique"==$user->fonction)selected @endif>Service Logistique</option>
                                            <option value="Service Informatique" @if("Service Informatique"==$user->fonction)selected @endif>Service Informatique</option>
                                            <option value="Architecte - Bureau Etude" @if("Architecte - Bureau Etude"==$user->fonction)selected @endif>Architecte - Bureau d'étude</option>
                                            <option value="Prof. Juridique et reglementee" @if("Prof. Juridique et reglementee"==$user->fonction)selected @endif>Prof. Juridique et réglementée</option>
                                            <option value="Prof. Lib-Consultant" @if("Prof. Lib-Consultant"==$user->fonction)selected @endif>Prof. Lib - Consultant</option>
                                            <option value="Elu-Maire" @if("Elu-Maire"==$user->fonction)selected @endif>Elu/Maire</option>
                                            <option value="Comite Entreprise" @if("Comite Entreprise"==$user->fonction)selected @endif>Comité d'entreprise</option>
                                            <option value="Autres" @if("Autres"==$user->fonction)selected @endif>Autres</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" value="{{$user->email}}" id="email" class="form-control" autocomplete="off" required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input type="text" name="phone" value="{{$user->phone}}" id="phone" class="form-control" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label for="ville">Ville</label>
                                        <input type="text" name="ville" id="ville" value="{{$user->ville}}" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="pays">Pays</label>
                                        <select id="pays" name="pays" class="form-control">
                                            <option value="{{$user->pays}}"></option>
                                            @foreach($countries as $country)
                                                <option value="{{$country->id}}" @if($user->country_id==$country->id) selected @endif>{{ $country->pays }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        @if($user->password=="")
                                            <label for="pass1">Mot de passe</label>
                                            <input type="password" name="password" id="pass1" class="form-control" autocomplete="off" required>
                                        @else
                                            <label for="pass2">Nouveau mot de passe</label>
                                            <input type="password" name="password" id="pass2" class="form-control" autocomplete="off">
                                            <input type="password" value="{{$user->password}}" name="lastpass" id="lastpass" style="display: none"/>
                                            <p class="description">Si vous voulez changer de mot de passe entrez un nouveau. Sinon laissez vide.</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <input name="save" type="submit" value="Enregistrer" class="btn btn-default">

                                        <p>&nbsp;</p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
