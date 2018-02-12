@extends('front.layout')
@section('content')
        <!--search bar-->
@include('front.annonce.searchbar')
        <!--Premium Advertisement-->
@include('front.inc.premium')
@include('front.inc.largepub')
        <!--Category-->
@include('front.inc.categories')<!--end advertisement-->
@stop
