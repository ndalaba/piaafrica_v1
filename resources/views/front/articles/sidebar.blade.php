<div class="post-sidebar">
    @if((count($lasts)>0))
        <div class="latest-post-content">
            <h2>Dernières actualités</h2>
            @foreach($lasts as $p)
                <div class="latest-post clearfix">
                    <div class="post-image">
                        <img src="{{$p->imagelink}}" alt="{{$p->titre}}">
                    </div>

                    <h4><a href="{{$p->link}}" title="{{$p->titre}}">{{$p->titre}}</a></h4>

                    <p>{{ str_limit(strip_tags($p->contenu),50) }}.</p>

                    <a class="read-more" href="{{$p->link}}" title="En savoir plus sur - {{$p->titre}} "><i class="fa fa-angle-right"></i>Détail</a>
                </div> <!-- end .latest-post -->
            @endforeach
        </div>
    @endif

    <div class="post-categories">

        <h2>Catégories</h2>

        <ul>
            @foreach($sections as $s)
                <li>
                    <a href="{{url('actualites/'.$s->slug)}}" title="actualites entreprises guinéennes - {{$s->section}}"><i class="fa fa-angle-right"></i>{{$s->section}}
                    </a></li>
            @endforeach
        </ul>
    </div>

   @include('front.inc.pub-square')
    <!-- end .sqare-button -->
    @include('front.entreprise.inc.une')

    @include('front.inc.pub-medium')

</div>
