@foreach($annonces as $val)
    <div class="col-sm-4 col-xs-6">
        <div class="single-product">
          @if($val->entreprise)
            <figure style="width:180px">
              @if($val->entreprise->logo!=null)
                <a href="{{$val->entreprise->link}}" title="{{ $val->entreprise->name }}" target="_blank">
                  <img src="{{ $val->entreprise->imagelink }}" alt="{{$val->entreprise->name}}">
                </a>
              @endif
            </figure>
          @endif
            <h4><a href="{{$val->link}}" title="{{ $val->titre }}">{{ $val->titre }}</a></h4>
            <h6>
                {{ \App\Http\Models\Help::timestampToDate($val->fin) }} |
                {{$val->type}} |
                <a href="{{ url('emploi/'.$val->section->slug) }}" title="{{ $val->section->section }}">{{ $val->section->section }}</a> |
                @if($val->entreprise)  <a href="{{ url('emplois/recherche?q=&type=&pays=&ville=&section=&entreprise='.$val->entreprise->slug) }}" title="{{ $val->entreprise->name }}">{{ $val->entreprise->name }}</a> |  @endif
                {{$val->ville->ville}}-{{$val->ville->country->pays}}
            </h6>

            <p>{{ strip_tags(str_limit($val->description,200)) }}</p>
        </div>

    </div>
@endforeach
