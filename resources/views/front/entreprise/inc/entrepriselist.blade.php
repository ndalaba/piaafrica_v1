@foreach($entreprises as $val)
    <div class="col-sm-4 col-xs-6">
        <div class="single-product">
            <figure>
                @if($val->logo!=null)
                    <img src="{{ $val->imagelink }}" alt="{{$val->name}}">
                @endif
            </figure>
            <h4><a href="{{$val->link}}" title="{{ $val->name }}">{{ $val->name }}</a></h4>
            <h5>{{ $val->domaine }} - <a href="{{ url('entreprise/'.$val->section->slug) }}" title="{{ $val->section->section }}">{{ $val->section->section }}</a></h5>

            <p>{{ $val->adresses[0]->adresse }}.-{{$val->ville->ville}}</p>

            <div class="btn-group-vertical" role="group" aria-label="Default button group">
                <a href="tel:{{ $val->adresses[0]->phone }}" title="Appeler {{$val->name}}" class="btn btn-sm"><i class="fa fa-phone"></i> Appeler</a>
                <a href="mailto:{{urlencode($val->email)}}" title="Ecrire à {{$val->name}}" class="btn btn-sm"><i class="fa fa-envelope-o"></i> Message</a>
                <a href="{{ $val->link }}" class="btn btn-sm" title="Consuter le détail sur {{$val->name}} "><i class="fa fa-folder-open"></i> Voir la fiche</a>
            </div>
        </div>

    </div>
@endforeach
