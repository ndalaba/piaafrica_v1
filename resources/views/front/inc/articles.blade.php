<div class="product-details-list">
    <div class="tab-content">
        <div class="tab-pane active" id="category-book">
            <h2>Dossiers</h2>

            <div class="row clearfix">
                @foreach($articles as $article)
                    <div class="col-sm-4 col-xs-6">

                        <div class="single-product">
                            @if(!empty($article->image))
                                <figure>
                                    <img src="{{$article->imagelink}}" alt="{{ $article->titre}}">
                                </figure>
                            @endif

                            <h4>
                                <a href="{{$article->link}}" title="{{ $article->titre}}">{{ $article->titre}}</a>
                            </h4>

                            <h5>
                                <a href="{{ url('actualites/'.$article->section->slug)}}" title="{{$article->section->section}}">{{$article->section->section}}</a>
                            </h5>

                            <p>{{ str_limit(strip_tags($article->contenu),140)}}.</p>

                            <a class="read-more" href="{{$article->link}}" title="{{ $article->titre}}"><i class="fa fa-angle-right"></i>Lire</a>

                        </div>
                        <!-- end .single-product -->
                    </div>
                @endforeach
            </div>
            <!-- end .row -->
        </div>
        <!-- end .tabe-pane -->
    </div>

    @include('front.inc.pub-add')

</div>
