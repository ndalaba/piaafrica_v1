@extends('front.layout')
@section('title') Enregistrer votre entreprise - @parent @stop
@section('header')
    <div class="header-search fixed-height">
        @include('front.inc.search')

        <div class="page-heading blog-list-heading">
            <span></span> <!-- for dark-overlay on the bg -->

            <div class="container">

                <h1>{{ $entreprise->name }} - Adresses</h1>

                <div class="heading-link">
                    <a href="{{url('/')}}" title="Page d'accueil {{config('application.name')}}">Accueil</a>

                    <i>/</i>

                    <a href="{{ url('annuaire') }}" title="Annuaire entreprises guinéennes">annuaire</a>
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
    @include('admin.inc.tinymce')
    <div id="page-content">
        <div class="container">
            <div class="page-content">
                <div class="contact-us">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="contact-form">
                                @if(Session::has('success'))
                                    <div class="alert alert-success">
                                        <p class="fa">Enregistré </p>
                                    </div>
                                @elseif(Auth::user())
                                    <p>Adresses de
                                        <a href="{{ url('publier-entreprise/'.$entreprise->id) }}" class="btn btn-primary btn-sm ajax"><i class="fa fa-backward"></i>  {{ $entreprise->name }}
                                        </a>
                                    </p>
                                @endif
                                @include('admin.errors')
                                    <div class="col-md-6">
                                        <form class="form-inline" method="get" action="{{url('entreprises-detail/adresse-action')}}">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th>Adresse</th>
                                                        <th>Téléphone</th>
                                                        <th>Ville</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($adresses as $cat)
                                                        <tr>
                                                            <td>
                                                                <strong>
                                                                    <a  style="float: left; width: 100%" class="ajax" href="{{ url('entreprise-detail/adresse/'.$entreprise->id.'/'.$cat->id) }}" title="Modifier">{{$cat->adresse}}</a>
                                                                </strong>

                                                                <div class="row-actions">
                                                                    <span class="edit"><a style="color: #3ab795" href="{{ url('entreprise-detail/adresse/'.$entreprise->id.'/'.$cat->id) }}">Modifier</a></span>
                                                                    |
                                                                    <span class="delete"><a style="color: red" href="{{ url('entreprise-detail/adresse-delete/'.$entreprise->id.'/'.$cat->id) }}">Supprimer </a>  </span>
                                                                </div>
                                                            </td>
                                                            <td>{{$cat->phone}}</td>
                                                            <td>{{$cat->ville->ville}}</td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-md-6">
                                        @if(is_null($adresse->id))
                                            <h3>Ajouter un nouveau adresse</h3>
                                        @else
                                            <h3>Modifier le adresse <strong>{{$adresse->adresse}}</strong></h3>
                                        @endif
                                        @if(is_null($adresse->id))
                                            <form method="post" action="{{url('entreprises-detail/create-adresse')}}" class="form">
                                                @else
                                                    <form  method="post" action="{{url('entreprise-detail/update-adresse')}}" class="form">
                                                        <input type="hidden" name="_method" value="PUT">
                                                        <input type="hidden" name="id" value="{{$adresse->id}}">
                                                        @endif
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <input type="hidden" name="entreprise_id" value="{{ $entreprise->id }}">
                                                        <div class="form-group">
                                                            <label for="adresse">Téléphone</label>
                                                            <input class="form-control" name="phone" id="phone" type="text" value="{{$adresse->phone}}" autocomplete="off" required="true">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="pays">Ville</label>
                                                            <select name="ville_id" id="ville_id" required class="form-control">
                                                                <option value=""></option>
                                                                @foreach($villes as $ville)
                                                                    <option value="{{$ville->id}}" @if($ville->id==$adresse->ville_id) selected @endif>{{ $ville->ville }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="description">Adresse</label>
                                                            <textarea name="adresse" id="adresse"  class="form-control">{{$adresse->adresse}}</textarea>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                                                    </form>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
