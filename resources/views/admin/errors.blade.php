@if(Session::has('error'))
    <div class="alert alert-danger">
        <p>{!! Session::get('error') !!}</p>
    </div>
@endif
@if($errors->any())
    <div class="alert alert-danger">
        <p>
            @foreach($errors->all() as $error)
                {!! $error !!} <br/>
            @endforeach
        </p>
    </div>
@endif