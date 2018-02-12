<div class="ads-list">
    <div class="media">
        <div class="ads pull-left">
            <a href="{{ url('annonce/'.$annonce->typeannonce.'/'.$annonce->categorie->slug.'/'.$annonce->slug.'?a='.$annonce->id) }}"  title="{{ $annonce->titre.' '.$annonce->prix.' '.$annonce->monnaie }}">
                <img src="{{asset('uploads/images/'.$annonce->principale)}}"  alt="{{ $annonce->titre.' '.$annonce->prix.' '.$annonce->monnaie }}">
            </a>
            <div class="ads-title">
                <p><a  href="{{ url('annonce/'.$annonce->typeannonce.'/'.$annonce->categorie->slug.'/'.$annonce->slug.'?a='.$annonce->id) }}" title="{{ $annonce->titre.' '.$annonce->prix.' '.$annonce->monnaie }}">{{$annonce->titre}}</a></p>
            </div>
            <a href="{{ url('annonce/'.$annonce->typeannonce.'/'.$annonce->categorie->slug.'/'.$annonce->slug.'?a='.$annonce->id) }}"  title="{{ $annonce->titre.' '.$annonce->prix.' '.$annonce->monnaie }}"  class="ads-hover">
                <span>{{ \App\Http\Models\Help::toMoney($annonce->prix,$annonce->monnaie) }}</span>
                <i class="{{$annonce->categorie->section->faimage}}"></i>
            </a>
        </div>
        <div class="media-body">
            <h4 class="title"><a href="{{ url('annonce/'.$annonce->typeannonce.'/'.$annonce->categorie->slug.'/'.$annonce->slug.'?a='.$annonce->id) }}" title="{{ $annonce->titre.' '.$annonce->prix.' '.$annonce->monnaie }}" class="col">{{$annonce->titre}} </a></h4>
            <p class="text">{!! str_limit($annonce->description,200,'...') !!}</p>
            <ul class="list-inline list-unstyled">
                <li><span> <a class="col" href="{{ url('categories/'.$annonce->categorie->slug) }}"> <i class="fa fa-tags"></i> {{ $annonce->categorie->categorie }} </a></span></li>
                <li><span> <i class="fa fa-ticket"></i> {{ $annonce->ville }} </span></li>
                <li><span> <i class="fa fa-clock-o"></i> {{ \App\Http\Models\Help::afficherDateRelative($annonce->created_at) }} </span></li>
                <!--<a href="{{ url($annonce->categorie->slug.'/'.$annonce->slug) }}" title="{{ $annonce->titre.' '.$annonce->prix.' '.$annonce->monnaie }}" class="links pull-right">Détails</a>-->
            </ul>
        </div>
    </div>
</div>