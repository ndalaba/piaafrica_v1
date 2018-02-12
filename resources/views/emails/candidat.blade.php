@extends('emails.layout')
@section('content')
    <br>
    <br>
    <p>
        <strong>Bienvenue, {{$param['name']}}</strong>
    </p><br>
    <p>
        Nous sommes heureux de votre présence.
    </p>

    <p>
        Pour accélérer votre recherche d'emploi, complétez votre profil <br/>

        1- PHOTO <br/>

        2- CV <br/>

        3- PROFESSION <br/>

        4- EXPÉRIENCE <br/>

        ..... <br/><br/>

        <a href="{{ url('candidat/edit-info/'.$param['id']) }}">Completer mon profil (pays, ville, profession ..)</a>
         ou
        <br/> <br/>
        <a href="{{ url('candidat/details/') }}">Détails de votre compte (civilité, expérience, photo, langue, cv...)</a>
        <br/>
        <br/>
        <strong>Vous aurez ainsi plus de chance d'être détectés par les récruteurs.</strong>
    </p>


@endsection
