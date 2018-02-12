<div class="post-sidebar">
    @if((count($annonces)>0))
        <div class="latest-post-content">
            <h2 style="text-transform: inherit">Les candidats ayant postulé à cette offre ont également postulé à ces offres </h2>
            @foreach($annonces as $val)
                <div class="latest-post clearfix">
                    @if($val->entreprise)
                        <div class="post-image">
                            @if($val->entreprise->logo!=null)
                                <img src="{{ $val->entreprise->imagelink }}" alt="{{$val->entreprise->name}}">
                            @endif
                        </div>
                    @endif
                    <h4><a href="{{$val->link}}" title="{{ $val->titre }}">{{ $val->titre }}</a></h4>
                    <h6>
                        {{ \App\Http\Models\Help::timestampToDate($val->fin) }} |
                        {{$val->type}} |
                        <a href="{{ url('emploi/'.$val->section->slug) }}" title="{{ $val->section->section }}">{{ $val->section->section }}</a> |
                        @if($val->entreprise)
                            <a href="{{ url('emplois/recherche?q=&type=&pays=&ville=&section=&entreprise='.$val->entreprise->slug) }}" title="{{ $val->entreprise->name }}">{{ $val->entreprise->name }}</a> |  @endif
                        {{$val->ville->ville}}-{{$val->ville->country->pays}}
                    </h6>
                </div> <!-- end .latest-post -->
            @endforeach
        </div>
    @endif
    @include('front.inc.pub-square')
    <!-- end .sqare-button -->
    @include('front.entreprise.inc.une')

    @include('front.inc.pub-medium')

    @include('front.inc.pub-square')

</div>
