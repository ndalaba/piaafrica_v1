@extends('front.layout')
@section('title') Enregistrer votre entreprise - @parent @stop
@section('header')
    <div class="header-search fixed-height">
        @include('front.inc.search')

        <div class="page-heading blog-list-heading">
            <span></span> <!-- for dark-overlay on the bg -->

            <div class="container">

                <h1>{{ $entreprise->name }} - A propos</h1>

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
                                    A Propos de
                                    <a href="{{ url('publier-entreprise/'.$entreprise->id) }}" class="btn btn-primary btn-sm ajax"><i class="fa fa-backward"></i>  {{ $entreprise->name }}
                                    </a>
                                @endif
                                @include('admin.errors')
                                <form method="post" action="{{url('entreprise-detail/about/'.$entreprise->id)}}" class="comment-form">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="entreprise_id" value="{{$entreprise->id}}"/>

                                    <div class="form-group">
                                        <label for="facebook">Facebook</label>
                                        <input type="text" name="facebook" value="{{$about->facebook}}" id="facebook" class="form-control"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="twitter">Twitter</label>
                                        <input type="text" name="twitter" value="{{$about->twitter}}" id="twitter" class="form-control"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="googleplus">Google+</label>
                                        <input type="text" name="googleplus" value="{{$about->googleplus}}" id="googleplus" class="form-control"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="linkedin">Linkedid</label>
                                        <input type="text" name="linkedin" value="{{$about->linkedin}}" id="linkedin" class="form-control"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea name="description" id="contenu" class="form-control" style="height: 400px;">{!! $about->description !!}</textarea>
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
@stop
