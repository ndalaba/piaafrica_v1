@extends('emails.layout')
@section('content')
    <br>
    <br>
    <p>
        <strong>Bienvenue, {{$param['name']}}</strong>
    </p>
    <br>
    <p>
        Nous sommes heureux de votre présence.
    </p>

    <p>
        Commencez dès maintenant à renseigner les informations de votre entreprise à cette adresse
        <a href="{{ url('publier-entreprise') }}">Inscrire mon entreprise</a>
        <br/> <br/>
        Sinon réclamer une entreprise déjà inscrite sur {{ config('application.name') }} pour qu'elle soit liée à votre compte en nous contactant directement par courriel (email).
        <br/>
    </p>

@endsection