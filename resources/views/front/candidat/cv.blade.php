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
    @include('admin.inc.tinymce')
    <div id="page-content">
        <div class="container">
            <div class="page-content">
                <div class="contact-us">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="contact-form">
                                @if(isset($success))
                                    <div class="alert alert-success">
                                        <p><span style="font-weight: bold; color: green">CV enregistré</span>
                                            <a href="{{ url('candidat/mon-compte') }}" class="btn btn-sm btn-info" style="float: right">retour à mon compte </a>
                                        </p>
                                    </div>
                                @endif
                                @include('admin.errors')

                                <form action="{{ url('candidat/cv') }}" method="post" class="comment-form" enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    @if(!is_null($user->id))
                                        <input type="hidden" name="id" value="{{$user->id}}">
                                    @endif

                                    <h3 class="inner-heading">Coller ou saisir votre CV</h3>

                                    <div class="form-group">
                                        <textarea name="cv" id="contenu" cols="30" rows="10" style="height: 400px">
                                            @if($user->candidat)
                                                {{$user->candidat->cv}}
                                            @endif
                                        </textarea>
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
