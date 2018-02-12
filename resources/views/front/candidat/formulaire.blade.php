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
                                        <p><span style="font-weight: bold; color: green">Compte enregistré</span>
                                            <a href="{{ url('candidat/mon-compte') }}" class="btn btn-sm btn-info" style="float: right">retour à mon compte </a>
                                        </p>
                                    </div>
                                @endif
                                @include('admin.errors')

                                <form action="{{ url('candidat/register') }}" method="post" class="comment-form" enctype="multipart/form-data">
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
                                        <label for="fonction">Profession</label>
                                        <input type="text" class="form-control" value="{{$user->fonction}}" name="fonction" id="fonction" required>
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
                                        <label for="country_id">Pays</label>
                                        <select name="country_id" id="country_id" required class="form-control">
                                            <option value=""></option>
                                            @foreach($countries as $country)
                                                <option value="{{$country->id}}" @if($user->ville) @if($country->id==$user->ville->country_id) selected @endif @endif>{{ $country->pays }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="ville_id">Ville</label>
                                        <select name="ville_id" id="ville_id" required class="form-control">
                                            <option value=""></option>
                                            @foreach($villes as $ville)
                                                <option value="{{$ville->id}}" @if($ville->id==$user->ville_id) selected @endif>{{ $ville->ville }}</option>
                                            @endforeach
                                        </select>
                                        <input type="text" id="ville" class="form-control" style="display: none" name="ville">
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

