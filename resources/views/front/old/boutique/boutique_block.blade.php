<div class="ads-list">
    <div class="media">
        <div class="ads pull-left">
            <a href="{{ url('boutique/'.str_replace('/','-',$boutique->annonceur->section->section) .'/'.$boutique->slug.'?b='.$boutique->id) }}"  title="{{ $boutique->annonceur->titre}}">
                <img src="{{asset('uploads/logos/'.$boutique->annonceur->principale)}}"  alt="{{ $boutique->annonceur->titre}}">
            </a>
            <div class="ads-title">
                <p><a   href="{{ url('boutique/'.str_replace('/','-',$boutique->annonceur->section->section).'/'.$boutique->annonceur->slug.'?b='.$boutique->id) }}"  title="{{ $boutique->annonceur->titre}}">{{ $boutique->annonceur->titre}}</a></p>
            </div>
        </div>
        <div class="media-body">
            <h4 class="title"><a  href="{{ url('boutique/'.str_replace('/','-',$boutique->annonceur->section->section).'/'.$boutique->annonceur->slug.'?b='.$boutique->id) }}"  title="{{ $boutique->annonceur->titre}}"  class="col">{{$boutique->annonceur->titre}} </a></h4>
            <p class="text">{{ $boutique->annonceur->slogan }}</p>
            <p>{!! $boutique->annonceur->adresse !!}</p>
            <p>{{ $boutique->annonceur->ville.' - ' .$boutique->annonceur->pays}}</p>
        </div>
    </div>
</div>