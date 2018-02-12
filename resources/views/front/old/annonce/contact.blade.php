@extends('front.layout')
@section('title') {{$annonce->titre}} - @parent @stop
@section('description'){{$annonce->description}}  ! - @parent @stop
@section('ogtitle') {{$annonce->titre}} @stop
@section('ogdescription') {{$annonce->description}} @stop
@section('ogimage') {{asset('uploads/images/'.$annonce->logo)}} @stop

@section('content')

    <section id="detail">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    @include('front.annonce.toauthor')
                </div>
                <div class="col-md-5">
                    <div class="ads-detail">
                        @if($annonce->user->droit==config('application.professionel'))
                         @include('front.annonce.author')
                        @endif
                            @include('front.annonce.addetail')
                        <!--end ad-detail-->
                    </div>
                </div>

            </div>
        </div>
    </section>
@stop
