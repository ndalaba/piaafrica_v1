@extends('emails.layout')
@section('content')
    <br>
    <br>

    <p>
        <strong>Bonjour {{$param['name']}},</strong>
    </p><br>
    <p>Bienvenue parmi la communauté {{ config('application.name') }}  :)</p>

    <p>
        Nous avons bien reçu votre publication "{{$param['sujet']}}".
    </p>

    <p>
        Malheureusement nous avons été obligés de la supprimer car elle allait à l'encontre de notre
        <a href="{{url('regles-generales')}}"> charte de modération</a>
        <br/>

        Nous vous remercions de bien respecter les règles de la communauté lors de vos prochaines interactions sur {{ config('application.name') }}..

        Si vous avez besoin de plus d'information concernant cette suppression n'hésitez pas à nous écrire en répondant à ce mail.
    </p>


@endsection