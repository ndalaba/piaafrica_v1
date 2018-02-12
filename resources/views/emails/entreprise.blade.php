@extends('emails.layout')
@section('content')
    <br><br>
    <p>
        <strong>Bonjour,</strong>
    </p>
    <br>
    <p>
        Bienvenue parmi la communauté {{ config('application.name') }}  :)
    </p>

    <p>
        Votre entreprise est en cours de validation et sera accessible à cette adresse
        <a href="{{$param['lien']}}">{{$param['name']}}</a>
        <br/><br/>

        Dans les semaines qui suivent votre inscription, votre fiche piaafrica.com remontera dans les résultats pertinents des moteurs de recherche (Google, Yahoo...).
        <br/><br/>

        Ce mécanisme sera renforcé si vous remplissez votre fiche en détails et que vous la mettez à jour régulièrement. Vos clients potentiels pourront alors vous contacter ou se rendre sur votre site Internet via votre fiche.
        <br/><br/>

        En vous inscrivant, vous donnez gratuitement un coup de pouce à votre activité ! <br/><br/><br/>

    </p>

@endsection
