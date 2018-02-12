<!DOCTYPE html>
<html>
<head lang="fr">
    <meta charset="UTF-8">
    <meta name="description" content="@section('description'){{ config('application.description') }}@show">
    <meta name="author" content="{{ config('application.author') }}">
    <meta name="application-name" content="{{ config('application.name') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title data-titre="{{ config('application.name') }}">@section('title'){{ config('application.name') }}@show</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">

    <meta property="og:title" content="@section('ogtitle'){{ config('application.name') }}@show"/>
    <meta property="og:image" content="@section('ogimage'){{ asset('images/logo.png') }} @show"/>
    <meta property="og:description" content="@section('ogdescription'){{ config('application.description') }}@show"/>
    <meta property="og:type" content="article"/>
    <meta property="og:url" content="{{ \URL::current() }}"/>
    <meta property="og:site_name" content="Maakiti"/>
    <meta property="article:author" content="Facebook URL of author profile"/>
    <meta property="article:publisher" content="https://www.facebook.com/Maakiti/"/>

    <!--  <meta property="article:published_time" content="2015-09-26T15:59:00+01:00" />
      <meta property="article:modified_time" content="2015-09-26T19:08:47+01:00" />
      <meta property="fb:admins" content="Facebook numeric admin ID" />
      <meta property="fb:app_id" content="Facebook numeric app ID" />
      <meta property="author" content="Author" />-->


    <link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,500,700,600,800,900,300' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/lib.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">

    <!--<link rel="stylesheet" type="text/css" href="{{ asset('css/default.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/responsive.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/owl.carousel.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/owl.theme.default.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/layerslider.css') }}">-->
</head>
<body>

<!--Start Header section-->
@include('front.inc.header')

@yield('content')
<!--Footer-->
@include('front.inc.footer')
<!--End Footer-->
@section('script')
    <script>
        var $url = "{{url('')}}";
        var $image_size ={{config('application.image_size')}};
        var $image_size_help ="{{config('application.image_size_help')}}";
    </script>
    <script src="{{ asset('js/lib.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.js') }}"></script>
    <script src="{{ asset('js/default.js') }}"></script>
    <script src="{{ asset('js/greensock.js') }}"></script>
    <script src="{{ asset('js/layerslider.kreaturamedia.jquery.js') }}"></script>
    <script src="{{ asset('js/layerslider.transitions.js') }}"></script>
@show
</body>
</html>
