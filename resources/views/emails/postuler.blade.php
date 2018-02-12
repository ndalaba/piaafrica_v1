@extends('emails.layout')
@section('content')
    <br>
    <br>

    {!! nl2br($param['message']) !!}

@endsection