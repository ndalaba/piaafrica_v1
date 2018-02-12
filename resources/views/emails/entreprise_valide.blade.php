@extends('emails.layout')
@section('content')
    <br>
    <br>
    <p>
        <strong>Bonjour,</strong>
    </p>
    <br/>
    <p>
        Bienvenue parmi la communauté {{ config('application.name') }}
    </p>
    <br/>
    <p>
        Votre entreprise a été validée et est accessible à cette adresse
        <a href="{{$param['lien']}}">{{$param['entreprise']}}</a>
        <br/><br/>
        <strong>Ajouter des informations relatives à votre entreprises</strong> <br/><br/>
        <a href="{{ url('entreprise-detail/about/'.$param['id']) }}">A propos de votre entreprise</a>
        <br/>
        <a href="{{ url('entreprises-detail/services/'.$param['id']) }}">Vos services</a>
        <br/>
        <a href="{{ url('entreprises-detail/produits/'.$param['id']) }}">Vos produits</a>
        <br/>
        <a href="{{ url('entreprises-detail/adresses/'.$param['id']) }}">Vos adresse</a>
        <br/>
        <a href="{{ url('entreprises-detail/partenaires/'.$param['id']) }}">Vos partenaires</a>
        <br/>

        Dans les semaines qui suivent votre inscription, votre fiche piaafrica.com remontera dans les résultats pertinents des moteurs de recherche (Google, Yahoo...).
        <br/><br/>

        Ce mécanisme sera renforcé si vous remplissez votre fiche en détails et que vous la mettez à jour régulièrement. Vos clients potentiels pourront alors vous contacter ou se rendre sur votre site Internet via votre fiche.
        <br/><br/>

        En vous inscrivant, vous donnez gratuitement un coup de pouce à votre activité ! <br/><br/><br/>

    </p>

@endsection
