@extends('front.layout')
@section('title') Déposer une pétite annonce - @parent @stop
@section('description')Envie de vendre, louer un bien personnel ? Déposer votre annonce gratuitement sur maakiti.com, le plus grand site de petites annonces dans votre région ! - @parent @stop
@section('content')

    <section id="page-head">
        <div class="container">
            <div class="row col-md-12">
                <div class="page-heading">
                    <h1>Déposer une annonce sur Maakiti.com est GRATUIT.</h1>
                </div>
            </div>
        </div>
    </section>
    <!--Category-->
    <section id="detail" class="publierApp">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-content" style="float:left">
                        <p><strong>Déposer une annonce sur Maakiti.com est GRATUIT.</strong><br>
                            Votre annonce va être contrôlée dans les 24h, et vous recevrez un email de validation une fois votre annonce en ligne. Elle restera sur le site pendant 60 jours<br>
                            Pendant cette période, vous pourrez la supprimer à tout moment.<br>
                            <a href="{{url('regles-generales')}}" target="_blank" class="col">Voir les règles de diffusion</a>
                        </p>

                        <p>Professionnels des catégories Véhicules, Immobilier, Maison, Loisirs, Emploi &amp; Services et Matériel Professionnel, la création d'un Compte est GRATUITE et obligatoire pour pouvoir déposer vos annonces sur Maakiti.com.&nbsp;<br>
                            <a class="col" href="{{url('compte-professionel')}}">En savoir plus</a></p>

                        <p>&nbsp;</p>

                        @if(Session::has('success'))
                            <div class="alert alert-success">
                                <p>Annonce publié.
                                    <a href="{{ url('mon-compte') }}" class="btn btn-sm btn-info" style="float: right"> Afficher mes annonces</a>
                                </p>

                            </div>
                        @endif
                        @include('admin.errors')

                        <form action="{{ url('annonces/publier') }}" method="post" id="post" class="form" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="user_id" value="{{ $annonce->user_id }}">
                            @if(!is_null($annonce->id))
                                <input type="hidden" name="id" value="{{$annonce->id}}">
                            @endif

                            <h4 class="inner-heading">Catégories</h4>

                            <div class="form-group">
                                <label for="categorie_id">Categorie d'annonce</label>
                                <select name="categorie_id" id="categorie_id" required class="form-control">
                                    <option value=""></option>
                                    @foreach($categories as $section)
                                        <optgroup label="{{ $section->section }}">
                                            @foreach($section->categories as $cat)
                                                <option value="{{$cat->id}}" @if($cat->id==$annonce->categorie_id)selected @endif>{{ $cat->categorie }}</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>

                            <h4 class="inner-heading">Localisation</h4>

                            <div class="form-group">
                                <label for="ville">Ville</label>
                                <input type="text" name="ville" value="{{$annonce->ville}}" id="ville" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="pays">Pays</label>
                                <input type="text" name="pays" value="{{$annonce->pays}}" id="pays" class="form-control">
                            </div>
                            @if(!Auth::user())
                                <h4 class="inner-heading">Vos informations</h4>
                                <div class="form-group">
                                    <label for="ville">Nom</label>
                                    <input type="text" name="name" id="name" value="{{$user->name}}" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="ville">Email</label>
                                    <input type="email" name="email" value="{{$user->email}}" id="email" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="pays">Phone</label>
                                    <input type="text" name="phone" id="phone" value="{{$user->phone}}" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="pays">Mot de passe</label>
                                    <input type="password" name="password" id="password" class="form-control" required>
                                </div>
                            @endif
                            <h4 class="inner-heading">Votre annonce</h4>

                            <div class="form-group">
                                <label for="titre">Titre</label>
                                <input type="text" name="titre" value="{{$annonce->titre}}" id="titre" class="form-control">
                                <input name="slug" type="hidden" id="slug" value="{{$annonce->slug}}" style="font-weight: normal;font-size: 17px;width: 99%;">
                            </div>

                            <div class="form-group">
                                <label for="droit">Type</label>
                                <select name="type" id="type" class="form-control" required>
                                    <option value=""></option>
                                    <option value="0" {{(0==$annonce->type)?'selected':''}}>Offre</option>
                                    <option value="1" {{(1==$annonce->type)?'selected':''}}>Demande</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="contenu" class="form-control" style="height: 160px;">{{$annonce->description}}</textarea>
                            </div>
                            <div class="form-group" style="float:left; width:58%; margin-right:2%">
                                <label for="slogan">Prix</label>
                                <input type="text" name="prix" value="{{$annonce->prix}}" id="prix" class="form-control">
                            </div>
                            <div class="form-group" style="float:left; width:40%;">
                                <label for="monnaie">Monnaie</label>
                                <select name="monnaie" id="monnaie" class="form-control" required>
                                    <option value="">Monnaie</option>
                                    <option value="GNF" {{('GNF'==$annonce->monnaie)?'selected':''}}>GNF</option>
                                    <option value="FCFA" {{('FCFA'==$annonce->monnaie)?'selected':''}}>FCFA</option>
                                    <option value="&#x24;" {{('&#x24;'==$annonce->monnaie)?'selected':''}}>&#x24;</option>
                                    <option value="&#128;" {{('&#128;'==$annonce->monnaie)?'selected':''}}>&#128;</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="logo">
                                    <strong>Photo principale: </strong>Une annonce avec photo est 7 fois plus consultée qu'une annonce sans photo.</label>

                                <p class="help-block" style="font-weight:bold;color: #1B841B;">
                                    Format d'image valide ('png', 'gif', 'jpg', 'jpeg') n'excédant pas {{ config('application.image_size_help') }}
                                </p>

                                <div style="float:left;margin-top: 20px;padding: 10px;background-color: #EAEBF0!important;margin-bottom: 15px;">
                                    <div class="col-md-4" v-for="photo in photos">
                                        <img src="@{{photo.src}}" class="img-responsive img-radio" v-bind:style="{cursor: photo.cursor}" @click="upload(photo)" title="Choisir le fichier">
                                        <button type="button" class="btn btn-danger btn-sm remove" v-if="photo.uploaded" @click="remove(photo)">
                                        <i class="fa fa-remove"></i> Supprimer</button>
                                        <input type="file" name="fichier[]" value="logo" title="logo" style="display:none" class="photo@{{photo.id}}">
                                    </div>
                                </div>

                            </div>
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
@section('script')
    @parent
    <script type="text/javascript">
        var annonce_id ={{$annonce->id or 0}};
    </script>
    <script src="{{ asset('js/vue.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
@endsection
