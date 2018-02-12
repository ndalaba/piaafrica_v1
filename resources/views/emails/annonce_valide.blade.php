@extends('emails.layout')
@section('content')
    <br>
    <br>
    <p>
        <strong>Bonjour,</strong>
    </p><br>
    <p>
        Offre {{$param['entreprise']}}  -  {{ config('application.name') }}  :)

    </p>

    <p>
        Votre offre a été validée et est accessible à cette adresse
        <a href="{{$param['lien']}}">{{$param['entreprise']}}</a>
        <br/><br/>

    </p>

@endsection