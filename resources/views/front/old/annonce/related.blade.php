<div id="relatedAds">
    <h4 class="inner-heading">Annonces similaires</h4>
    <div class="row" style="margin: auto;width: 99%">
        @foreach($related as $annonce)
        <div class="col-sm-4 padding-control">
            <div class="ads">
                <a href="{{ url('annonce/'.$annonce->typeannonce.'/'.$categorie->slug.'/'.$annonce->slug.'?a='.$annonce->id) }}" title="{{ $annonce->titre.' '.$annonce->prix.' '.$annonce->monnaie }}">
                    <img src="{{asset('uploads/images/'.$annonce->principale)}}" alt="{{ $annonce->titre.' '.$annonce->prix.' '.$annonce->monnaie }}">
                </a>
                <div class="ads-title">
                    <p>
                        <a href="{{ url('annonce/'.$annonce->typeannonce.'/'.$categorie->slug.'/'.$annonce->slug.'?a='.$annonce->id) }}" title="{{ $annonce->titre.' '.$annonce->prix.' '.$annonce->monnaie }}">{{$annonce->titre}}</a>
                    </p>
                </div>
                <a href="{{ url('annonce/'.$annonce->typeannonce.'/'.$categorie->slug.'/'.$annonce->slug.'?a='.$annonce->id) }}" title="{{ $annonce->titre.' '.$annonce->prix.' '.$annonce->monnaie }}" class="ads-hover">
                    <span>{{ \App\Http\Models\Help::toMoney($annonce->prix,$annonce->monnaie) }}</span>
                    <i class="fa {{$categorie->section->faimage}} fa-2x"></i>
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>