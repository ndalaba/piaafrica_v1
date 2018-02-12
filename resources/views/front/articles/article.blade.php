<script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "NewsArticle",
  "mainEntityOfPage": {
    "@type": "WebPage",
    "@id": "https://google.com/article"
  },
  "headline": "{{$article->titre}}",
  "image": {
    "@type": "ImageObject",
    "url": "{{$article->imagelink}}",
    "height": 800,
    "width": 800
  },
  "datePublished": "{{$article->created_at}}",
  "dateModified": "{{$article->updated_at}}",
  "author": {
    "@type": "Person",
    "name": "{{ config('application.name') }}"
  },
   "publisher": {
    "@type": "Organization",
    "name": "{{ config('application.name') }}",
    "logo": {
      "@type": "ImageObject",
      "url": "https://piaafrica.com/images/logo.png",
      "width": 600,
      "height": 60
    }
  },
  "description": "{{ str_limit(strip_tags($article->contenu),150) }}"
}
</script>
@extends('front.layout')
@section('title'){{ $article->titre.'- '.$article->section->section }}@stop
@section('description') {{ str_limit(strip_tags($article->contenu),150) }} @stop
@section('ogtitle'){{ $article->titre.'- '.$article->section->section }}@stop
@section('ogdescription'){{ str_limit(strip_tags($article->contenu),150) }}@stop
@section('ogimage'){{$article->imagelink}}@stop
@section('header')
    <div class="header-search fixed-height">
        @include('front.inc.search')

        <div class="page-heading blog-list-heading">
            <span></span> <!-- for dark-overlay on the bg -->

            <div class="container">

                <h1>{{ $article->titre }}</h1>

                <div class="heading-link">
                    <a href="{{url('/')}}" title="Page d'accueil {{ config('application.name')}}">Accueil</a>

                    <i>/</i>

                    <a href="{{ url('actualites') }}" title="Actualités entreprises africaines">Actualités</a>
                </div>

            </div>
                          <!-- END .container-->
        </div>
    </div>
    <div class="header-nav-bar">
        <div class="container">
            @include('front.inc.menu')
        </div>
        <!-- end .container -->
    </div>
@stop
@section('content')
    <div id="page-content">
        <div class="container">
            <div class="page-content bl-list">
                <div class="row">
                    <div class="col-md-8">
                        <div class="blog-list blog-post">

                            <div class="post-with-image">
                                <div class="date-month">
                                    <a href="#">
                                        <span class="date">{{ \App\Http\Models\Help::jourMois($article->created_at)['jour'] }}</span>
                                        <span class="month">{{ \App\Http\Models\Help::jourMois($article->created_at)['mois'] }}</span>
                                    </a>
                                </div>
                                <div class="post-image">
                                    <img src="{{$article->imagelink}}" alt="{{$article->titre}}">
                                </div>

                                <h2 class="title"><a href="#" title="{{$article->section->section}} - {{$article->titre}}">{{$article->section->section}} - {{$article->titre}}</a></h2>

                                <p class="user">
                                    <a href="{{url('actualites/'.$article->section->slug)}}" title="{{$article->section->section}}"><i class="fa fa-folder"></i> {{$article->section->section}}</a>
                                </p>

                                <div class="post">
                                    {!! nl2br($article->contenu) !!}
                                </div>
                                @include('front.inc.share')
                                <!-- end .comment-section -->

                            </div>
                            <!-- end .post-with-image -->
                        </div>
                        <!-- end .blog-post -->

                    </div>

                    <div class="col-md-4">
                        @include('front.articles.sidebar')
                        <!-- end .post-sidebar -->
                    </div>
                    <!-- end .grid-layout -->

                </div>
                <!-- end .row -->
            </div>
            <!-- end .page-content -->
        </div>
        <!-- end .container -->

    </div>
@stop
