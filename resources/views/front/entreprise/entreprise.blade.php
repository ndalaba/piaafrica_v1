@extends('front.layout')
@section('title'){{ $entreprise->name.' '.$entreprise->section->section.' - '.$entreprise->domaine.' - '.$entreprise->adress->ville->ville}}@stop
@section('description') {{ str_limit(strip_tags($entreprise->about->description),150) }} @stop
@section('ogtitle'){{ $entreprise->name.' '.$entreprise->section->section.' - '.$entreprise->domaine.' - '.$entreprise->adress->ville->ville}}@stop
@section('ogdescription') {{ str_limit(strip_tags($entreprise->about->description),150) }} @stop
@section('ogimage'){{ $entreprise->imagelink }}@stop
@section('header')
    <div class="header-search company-profile-height">
        @include('front.inc.search')

        @include('front.entreprise.inc.header')
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
            <div class="row">
                <div class="col-md-9 col-md-push-3">
                    <div class="company-profile">

                        <div class="tab-content">
                            @include('front.entreprise.profile')
                            @if(!empty($entreprise->about->facebook && $entreprise->une ))
                                @include('front.entreprise.facebook')
                            @endif
                            @if(count($entreprise->services)>=1)
                                @include('front.entreprise.services')
                            @endif
                            @if(count($entreprise->produits)>=1)
                                @include('front.entreprise.produits')
                            @endif
                            @include('front.entreprise.inc.contacter')
                        </div>
                    </div>
                </div>
                @include('front.entreprise.sidebar')
                <!-- end .main-grid layout -->
            </div>
            <!-- end .row -->

        </div>
        <!-- end .container -->

    </div> <!-- end #page-content -->
    @if(count($entreprise->coordonnee)>=2)
        <script>
            var $lat ={{$entreprise->coordonnee[0]}};
            var $lng ={{$entreprise->coordonnee[1]}};
            function initMap() {
                var myLatLng = {lat: $lat, lng: $lng};
               /* var map = new google.maps.Map(document.getElementById('company_map_canvas'), {
                    center: myLatLng,
                    zoom: 16
                });*/
                var map2 = new google.maps.Map(document.getElementById('contact_map_canvas_one'), {
                    center: myLatLng,
                    zoom: 10
                });
               /* var marker = new google.maps.Marker({
                    position: myLatLng,
                    map: map,
                    title: '{{$entreprise->name}}'
                });*/
                var marker2 = new google.maps.Marker({
                    position: myLatLng,
                    map: map2,
                    title: '{{$entreprise->name}}'
                });
            }

        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAkcquazdYZItQUE9XKub2SVvZzY78yBHM&callback=initMap"
                async defer></script>
    @endif
@stop
<script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "NewsArticle",
  "mainEntityOfPage": {
    "@type": "WebPage",
    "@id": "https://google.com/article"
  },
  "headline": "{{$entreprise->name}}",
  "image": {
    "@type": "ImageObject",
    "url": "{{$entreprise->imagelink}}",
    "height": 800,
    "width": 800
  },
  "datePublished": "{{$entreprise->created_at}}",
  "dateModified": "{{$entreprise->updated_at}}",
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
  "description": "{{ str_limit(strip_tags($entreprise->about->description),150) }}"
}
</script>
