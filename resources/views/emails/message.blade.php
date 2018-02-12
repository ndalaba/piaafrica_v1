@extends('emails.layout')
@section('content')
    <br>
    <br>

    <p>
        <strong>{{$param['sujet']}},</strong>
    </p>
    <br>
    <p>
        {!! nl2br($param['message']) !!}
    </p>

    <br/><br/>

    <center>
        Nom:
        <small>{{$param['name']}}</small>
        <br/>

    </center>

    <br>
@endsection