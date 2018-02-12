<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title data-titre="{{ config('application.name') }}">@section('title')Tableau de bord ‹ {{ config('application.name') }}@show</title>
         <link href="{{ asset('/admin/css/bootstrap.css') }}" rel="stylesheet">
         <link href="{{ asset('/admin/css/bootstrap-multiselect.css') }}" rel="stylesheet">
         <link href="{{ asset('/admin/css/font-awesome.css') }}" rel="stylesheet">
         <link href="{{ asset('/admin/css/style.css') }}" rel="stylesheet">
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon.png') }}">
         <meta name="robots" content="noindex,follow">
        <!-- HTML5 Shiv and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div id="wrapper">
            @include('admin.inc.admin-bar')
            <!-- /. NAV TOP  -->
             @include('admin.inc.menu')

            <!-- /. SIDEBAR MENU (navbar-side) -->
            <div id="page-wrapper" class="page-wrapper-cls">
                @section('content')

                @show
                 <footer class="footer">
                    &copy; {{ date('Y')}} {{ config('application.name') }} | Par : <a href="http://guinee-webdev.com" target="_blank">GUINEE-WEBDEV</a>
                </footer>
            </div>
        </div>
        @section('script')
            <script>
              var $url="{{url('')}}";
            </script>
            <script src="{{ asset('admin/js/jquery-1.11.1.js') }}"></script>
            <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
            <script src="{{ asset('admin/js/bootstrap.js') }}"></script>
            <script src="{{ asset('admin/js/bootstrap-multiselect.js') }}"></script>
            <script src="{{ asset('admin/js/jquery.metisMenu.js') }}"></script>
            <script src="{{asset('admin/js/custom.js')}}"></script>
        @show

    </body>
</html>
