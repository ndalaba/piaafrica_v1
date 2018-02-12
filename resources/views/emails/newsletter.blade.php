@extends('emails.layout')
@section('content')
    <br>
    <br>
    <h1 style="font-weight: normal; font-size: 1.5em; line-height: 30px;">
        {{$param['titre']}}
    </h1>

    <div>
        {!! nl2br($param['message']) !!}
    </div>

    <img src="{{url('newsletters/opened/'.$param['id'])}}" alt="{{$param['titre']}}" style="display: none"/>
    <br>
    <br/>
@endsection