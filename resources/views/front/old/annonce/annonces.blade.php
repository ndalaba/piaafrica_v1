@extends('front.layout')
@section('content')
        <!--search bar-->
@include('front.annonce.searchbar')
        <!--Category-->
<section id="advertisement">
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
              <!--  <div class="main-heading text-center">
                    <h2>DERNIÈRES ANNONCES</h2>
                </div>-->
               @include('front.annonce.liste_annonces')
            </div>
           @include('front.inc.sidebar')
        </div>
    </div>
</section><!--end advertisement-->
  @include('front.inc.largepub')
@stop