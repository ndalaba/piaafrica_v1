@extends('front.layout')
@section('title') Edit un compte annonceur- @parent @stop
@section('description')Envie de vendre, louer un bien personnel ? Déposer votre annonce gratuitement sur maakiti.com, le plus grand site de petites annonces dans votre région ! - @parent @stop
@section('content')

    <section id="page-head">
        <div class="container">
            <div class="row col-md-12">
                <div class="page-heading">
                    <h1>Enregistrer un compte annonceur sur maakiti. C'est gratuit.</h1>
                </div>
            </div>
        </div>
    </section>
    <!--Category-->
    <section id="detail" class="publierApp">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-content" style="float:left; width: 100%">
                        @if(Session::has('success'))
                            <div class="alert alert-success">
                                <p>Compte enregistré
                                    <a href="{{ url('mon-compte') }}" class="btn btn-sm btn-info" style="float: right">
                                        Afficher mes annonces</a>
                                </p>
                            </div>
                        @endif
                        @include('admin.errors')

                        <form action="{{ url('edit-info') }}" method="post" id="post" class="form" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            @if(!is_null($user->id))
                                <input type="hidden" name="id" value="{{$user->id}}">
                            @endif

                            <h4 class="inner-heading">Vos informations</h4>

                            <div class="form-group">
                                <label for="nom">Nom</label>
                                <input type="text" name="name" value="{{$user->name}}" id="name" class="form-control" autocomplete="off" required="">
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

                            @if($user->droit>= config('application.professionel'))

                                <h4 class="inner-heading">Détails annonceurs</h4>

                                <div class="form-group">
                                    <label for="section_id">Section</label>
                                    <select name="section_id" id="section_id" class="form-control" required="">
                                        <option value=""></option>
                                        @foreach($sections as $section)
                                            <option value="{{$section->id}}" @if($section->id==$annonceur->section_id) selected @endif>{{$section->section}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="titre">Titre</label>
                                    <input type="text" name="titre" value="{{$annonceur->titre}}" id="titre" class="form-control" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="slogan">Slogan</label>
                                    <input type="text" name="slogan" value="{{$annonceur->slogan}}" id="slogan" class="form-control" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="web">Web</label>
                                    <input type="text" name="web" value="{{$annonceur->web}}" id="web" class="form-control" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="ville">Ville</label>
                                    <input type="text" name="ville" value="{{$annonceur->ville}}" id="ville" class="form-control" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="pays">Pays</label>
                                    <input type="text" name="pays" value="{{$annonceur->pays}}" id="pays" class="form-control" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="adresse">Adresse</label>
                                    <textarea name="adresse" id="adresse" class="form-control">{{$annonceur->adresse}}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="contenu" class="form-control">{{$annonceur->description}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="description">Publier sur le site</label>
                                    <input type="checkbox" name="publie" @if($annonceur->publie) checked @endif/>
                                </div>
                                <div class="form-group">
                                    <label for="logo">Logo professionnel</label>
                                    <input type="file" name="fichier" value="logo" title="logo" id="fichier">
                                    <input type="hidden" name="logo" value="{{$annonceur->logo}}" title="logo" id="logo">

                                    <p class="help-block">'png', 'gif', 'jpg', 'jpeg'</p>
                                </div>
                            @endif
                            <p style="float:left; width:100%">
                                <input name="save" type="submit" class="submit" id="publish" value="Enregistrer">
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section><!--end advertisement-->
    @include('front.inc.largepub')
@stop