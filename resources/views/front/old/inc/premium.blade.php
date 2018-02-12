<section id="premium">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="main-heading text-center">
                    <h2>ANNONCES A LA UNE</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="owl-carousel">
                @foreach($unes as $une)
                <div class="item">
                    <a href="{{ url('annonce/'.$une->typeannonce.'/'.$une->categorie->slug.'/'.$une->slug.'?a='.$une->id) }}" title="{{ $une->titre.' '.$une->prix.' '.$une->monnaie }}">
                        <img src="{{asset('uploads/images/'.$une->principale)}}" alt="{{ $une->titre.' '.$une->prix.' '.$une->monnaie }}"></a>
                    <div class="item-title"><a href="{{ url('annonce/'.$une->typeannonce.'/'.$une->categorie->slug.'/'.$une->slug.'?a='.$une->id) }}" title="{{ $une->titre.' '.$une->prix.' '.$une->monnaie }}">{{$une->titre}}</a></div>
                    <a href="{{ url('annonce/'.$une->typeannonce.'/'.$une->categorie->slug.'/'.$une->slug.'?a='.$une->id) }}" title="{{ $une->titre.' '.$une->prix.' '.$une->monnaie }}" class="item-hover"><span>{{ \App\Http\Models\Help::toMoney($une->prix,$une->monnaie) }}</span></a>
                </div>
                @endforeach
            </div><!--end carousel-->
        </div>
    </div>
</section><!--End Premium Advertisement-->