<!DOCTYPE html>
<html  lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="@section('description'){{ config('application.description') }}@show">
        <meta name="application-name" content="{{ config('application.name') }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title data-titre="{{ config('application.name') }}">@section('title'){{ config('application.name') }} - annuaire entreprises et institutions. Emplois en Afrique - Jobs in Africa @show</title>
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon.png') }}">
        <meta name="author" content="{{ config('application.name') }}">
        <meta property="og:title" content="@section('ogtitle'){{ config('application.name') }}@show"/>
        <meta property="og:image" content="@section('ogimage'){{ asset('images/logo.png') }} @show"/>
        <meta property="og:description" content="@section('ogdescription'){{ config('application.description') }}@show"/>
        <meta property="og:type" content="article"/>
        <meta property="og:url" content="{{ \URL::current() }}"/>
        <meta property="og:site_name" content="Pia Africa"/>
        <meta property="article:author" content="Pia Africa"/>
        <meta property="article:publisher" content="https://www.facebook.com/piaafrica"/>

        <link  href='https://fonts.googleapis.com/css?family=Raleway:400,500,700,600,800,900,300' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/style.min.css') }}">
        <!--[if IE 9]>
        <script src="{{ asset('js/media.match.min.js') }}"></script>
        <![endif]-->

    </head>
    <body>
        <div id="main-wrapper">
            <header id="header">
                @include('front.inc.top')

                 @yield('header')

            </header>

            @yield('content')

            @include('front.inc.footer')

        </div>
        @section('script')
            <script>
                var $url = "{{url('')}}";
                var $image_size ={{config('application.image_size')}};
                var $image_size_help ="{{config('application.image_size_help')}}";
            </script>
            <script src="{{ asset('js/jquery.js') }}"></script>
            <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
            <script src="{{ asset('js/jquery.ba-outside-events.min.js') }}"></script>
            <script src="{{ asset('js/bootstrap.min.js') }}"></script>
            <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
            <script src="{{ asset('js/script.min.js') }}"></script>
            <script src="{{ asset('js/custom.js') }}"></script>
        @show
    </body>
</html>
