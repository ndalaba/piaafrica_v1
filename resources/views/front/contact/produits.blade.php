@extends('front.layout')
@section('title') Enregistrer votre entreprise - @parent @stop
@section('header')
    <div class="header-search fixed-height">
        @include('front.inc.search')

        <div class="page-heading blog-list-heading">
            <span></span> <!-- for dark-overlay on the bg -->

            <div class="container">

                <h1>{{ $entreprise->name }} - Réalisations</h1>

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
                                    <p>Réalisations de
                                        <a href="{{ url('publier-entreprise/'.$entreprise->id) }}" class="btn btn-primary btn-sm ajax"><i class="fa fa-backward"></i>  {{ $entreprise->name }}
                                        </a>
                                    </p>
                                @endif
                                @include('admin.errors')
                                    <div class="col-md-6">
                                        <form class="form-inline" method="get" action="{{url('entreprises-detail/produit-action')}}">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th>Produit</th>
                                                        <th>Image</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($produits as $cat)
                                                        <tr>
                                                            <td>
                                                                <strong>
                                                                    <a  style="float: left; width: 100%" class="ajax" href="{{ url('entreprise-detail/produit/'.$entreprise->id.'/'.$cat->id) }}" title="Modifier">{{$cat->produit}}</a>
                                                                </strong>

                                                                <div class="row-actions">
                                                                    <span class="edit"><a style="color: #5F7A1B" href="{{ url('entreprise-detail/produit/'.$entreprise->id.'/'.$cat->id) }}">Modifier</a></span>
                                                                    |
                                                                    <span class="delete"><a style="color:red" href="{{ url('entreprise-detail/produit-delete/'.$entreprise->id.'/'.$cat->id) }}">Supprimer </a>  </span>
                                                                </div>
                                                            </td>
                                                            <td style="width: 40%">  <img src="{{$cat->imagelink}}" alt="{{$cat->produit}}" style="height: 70px"/></td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-md-6">
                                        @if(is_null($produit->id))
                                            <h3>Ajouter un nouveau produit</h3>
                                        @else
                                            <h3>Modifier le produit <strong>{{$produit->produit}}</strong></h3>
                                        @endif
                                        @if(is_null($produit->id))
                                            <form method="post" action="{{url('entreprises-detail/create-produit')}}" class="form" enctype="multipart/form-data">
                                                @else
                                                    <form  method="post" action="{{url('entreprise-detail/update-produit')}}" class="form" enctype="multipart/form-data">
                                                        <input type="hidden" name="_method" value="PUT">
                                                        <input type="hidden" name="id" value="{{$produit->id}}">
                                                        @endif
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <input type="hidden" name="entreprise_id" value="{{ $entreprise->id }}">
                                                        <div class="form-group">
                                                            <label for="produit">Produit</label>
                                                            <input class="form-control" name="produit" id="produit" type="text" value="{{$produit->produit}}" autocomplete="off" required="true">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="pays">Image</label>
                                                            <input type="file" name="fichier" id="fichier"/>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="description">Description</label>
                                                            <textarea name="description" id="description"  class="form-control">{{$produit->description}}</textarea>
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
