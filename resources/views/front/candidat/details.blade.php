@extends('front.layout')
@section('title') Edit un compte  @parent @stop
@section('header')
    <div class="header-search fixed-height">
        @include('front.annonce.search')

        <div class="page-heading blog-list-heading">
            <span></span> <!-- for dark-overlay on the bg -->

            <div class="container">

                <h1>Modifier mes informations</h1>

                <div class="heading-link">
                    <a href="{{url('/')}}">Accueil</a>

                    <i>/</i>

                    <a href="{{ url('candidat/mon-compte') }}">Compte</a>
                </div>

            </div>
                          <!-- END .container-->
        </div>
    </div>
    <div class="header-nav-bar">
        <div class="container">
            @if(Auth::user())
                @include('front.candidat.menu')
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
                                        <p>
                                            <span style="font-weight: bold; color: green">Détails compte enregistré</span>
                                            <a href="{{ url('candidat/mon-compte') }}" class="btn btn-sm btn-info" style="float: right">retour à mon compte </a>
                                        </p>
                                    </div>
                                @endif
                                @include('admin.errors')

                                <form action="{{ url('candidat/details') }}" method="post" class="comment-form" enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="user_id" value="{{$candidat->user_id}}">
                                    <h3 class="inner-heading">Détails de votre compte </h3>
                                    <div class="form-group">
                                        <label for="civilite">Civilité</label>
                                        <select name="civilite" id="civilite" class="form-control" required>
                                            <option value="">civilite</option>
                                            <option value="M" @if($candidat->civilite=="M") selected @endif>Monsieur</option>
                                            <option value="Mme" @if($candidat->civilite=="Mme") selected @endif>Madame</option>
                                            <option value="Mlle" @if($candidat->civilite=="Mlle") selected @endif>Mademoiselle</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="naissance">Naissance</label>
                                        <input type="date" name="naissance" value="{{$candidat->naissance}}" id="naissance" class="form-control datepicker" autocomplete="off" placeholder="aaaa-mm-jj">
                                    </div>
                                    <div class="form-group">
                                        <label for="niveau">Niveau de formation</label>
                                        <select id="niveau" name="niveau" class="form-control">
                                            <option value="">...</option>
                                            <option value="CAP" @if($candidat->niveau=="CAP") selected @endif>CAP</option>
                                            <option value="BEP" @if($candidat->niveau=="BEP") selected @endif>BEP</option>
                                            <option value="BAC" @if($candidat->niveau=="BAC") selected @endif>BAC</option>
                                            <option value="BAC+1" @if($candidat->niveau=="BAC+1") selected @endif>BAC+1</option>
                                            <option value="BAC+2" @if($candidat->niveau=="BAC+2") selected @endif>BAC+2</option>
                                            <option value="BAC+3" @if($candidat->niveau=="BAC+3") selected @endif>BAC+3</option>
                                            <option value="BAC+4" @if($candidat->niveau=="BAC+4") selected @endif>BAC+4</option>
                                            <option value="BAC+5" @if($candidat->niveau=="BAC+5") selected @endif>BAC+5</option>
                                            <option value="> BAC+5" @if($candidat->niveau=="> BAC+5") selected @endif>&gt; BAC+5</option>
                                        </select>
                                    </div>
                                    <datalist id="langues">
                                        <option value="Anglais">Anglais</option>
                                        <option value="Allemand">Allemand</option>
                                        <option value="Arabe">Arabe</option>
                                        <option value="Chinois">Chinois</option>
                                        <option value="Français">Français</option>
                                        <option value="Russe">Russe</option>
                                    </datalist>
                                    <div class="form-group">
                                        <label for="langue">Première langue</label>
                                        <input list="langues" type="text" name="langue" value="{{$candidat->langue}}" id="langue" class="form-control" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label for="languebis">Deuxième langue</label>
                                        <input list="langues" type="text" name="languebis" value="{{$candidat->languebis}}" id="languebis" class="form-control" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label for="linkedin">LinkedIn</label>
                                        <input type="text" name="linkedin" value="{{$candidat->linkedin}}" id="linkedin" class="form-control" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label for="specialite">Spécialité</label>
                                        <input type="text" name="specialite" value="{{$candidat->specialite}}" id="specialite" class="form-control" autocomplete="off" placeholder="programmation, architecture, conduite....">
                                    </div>
                                    <div class="form-group">
                                        <label for="experience">Combien d'année d'expérience</label>
                                        <input type="number" name="experience" value="{{$candidat->experience}}" id="experience" class="form-control" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label for="publie">Rendre mon profil publique (visible uniquement pour  les recruteurs)
                                            <input type="checkbox" name="publie" @if($candidat->publie) checked @endif id="publie" style="height: 20px;width: 20px;margin-right: 10px;"></label>
                                    </div>
                                    <div class="form-group">
                                        <label for="newsletter">Recevoir la newletter de {{config('application.name')}}
                                            <input type="checkbox" name="newsletter" @if($candidat->newsletter) checked @endif id="newsletter" style="height: 20px;width: 20px;margin-right: 10px;"></label>
                                    </div>
                                    <div class="form-group">
                                        <label for="adresse">Adresse</label>
                                        <textarea name="adresse" id="adresse" class="form-control" style="height: auto">{{$candidat->adresse}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="btn-bs-file btn btn-lg btn-default">
                                            @if($candidat->cvdoc)
                                                <span id="lblcv">{{$candidat->cvdoc}}</span>
                                            @else
                                                <span id="lblcv">Fichier cv au format 'pdf', 'doc', 'docx' <= {{config('application.image_size_help')}}</span>
                                            @endif
                                            <input type="file" name="cv" id="cv" onchange="loadfile(this,'#lblcv')"/>
                                        </label>
                                        <label class="btn-bs-file btn btn-lg btn-default">
                                            @if($candidat->photo)
                                            <span id="lbltof"> {{$candidat->photo}}</span>
                                            @else
                                            <span id="lbltof"> Photo au format 'png', 'gif', 'jpg', 'jpeg'  <= {{config('application.image_size_help')}}</span>
                                            @endif
                                            <input type="file" name="tof" id="tof" onchange="loadfile(this,'#lbltof')"/>
                                        </label>
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
@section('script')
    @parent
    <script type="text/javascript">
        $(document).ready(function () {
            $( ".datepicker" ).datepicker({ dateFormat: 'yy-mm-dd'});
        });
    </script>
@stop
