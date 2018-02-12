@extends('front.layout')
@section('content')
        <!--search bar-->
@include('front.boutique.searchbarboutique')
        <!--Category-->
<section id="advertisement">
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
              <!--  <div class="main-heading text-center">
                    <h2>DERNIÈRES ANNONCES</h2>
                </div>-->
               @include('front.boutique.liste_boutiques')
            </div>
           @include('front.boutique.sidebar')
        </div>
    </div>
</section><!--end advertisement-->
  @include('front.inc.largepub')
@stop
