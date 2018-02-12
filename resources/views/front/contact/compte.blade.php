@extends('front.layout')
@section('title') Compte {{ config('application.name') }} de {{ \Auth::user()->name }} - @parent @stop
@section('header')
    <div class="header-search fixed-height">
        @include('front.inc.search')

        <div class="page-heading blog-list-heading">
            <span></span> <!-- for dark-overlay on the bg -->

            <div class="container">

                <h1>Bonjour {{ \Auth::user()->name }}</h1>

                <div class="heading-link">
                    <a href="{{url('/')}}" title="Page d'accueil {{config('application.name')}}">Accueil</a>
                </div>

            </div>
                          <!-- END .container-->
        </div>
    </div>
    <div class="header-nav-bar">
        <div class="container">
           @include('front.contact.menu')
        </div>
        <!-- end .container -->
    </div>
@stop

@section('content')
    <div id="page-content">
        <div class="container">
            <div class="page-content bl-list">
                <div class="row">
                    <div class="col-md-12">
                        <div class="product-details-list">
                            <div class="tab-content">
                                <div class="tab-pane active" id="category-book">
                                    <div class="row clearfix">

                                    </div>
                                    <!-- end .row -->
                                </div>
                                <!-- end .tabe-pane -->
                            </div>
                        </div>

                    </div>

                </div>
                <!-- end .row -->
            </div>
            <!-- end .page-content -->
        </div>
        <!-- end .container -->

    </div>
@stop
