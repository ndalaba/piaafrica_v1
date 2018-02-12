@extends('emails.layout')
@section('content')
    <br>
    <br>

    <p>
        <strong>Bonjour,</strong>
    </p>
    <br>
    <p>
        Votre offre {{$param['name']}}

    </p>

    <p>
        Votre annonce est en cours de validation et sera accessible à cette adresse
        <a href="{{$param['lien']}}">{{$param['name']}}</a>
        <br/><br/>
    </p>

@endsection
