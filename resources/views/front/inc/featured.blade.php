<div class="featured-listing" id= "featured-list">
    <div class="container">
        <div class="row clearfix">
            <h2><strong>Top</strong> Entreprises</h2>
            @foreach($unes as $une)
                <div class="col-md-3 col-sm-4 col-xs-6">
                    <div class="single-product">
                        <figure>
                            <img src="{{ $une->imagelink }}" alt="{{$une->name}}">
                            <figcaption>
                               <!-- <div class="bookmark">
                                    <a href="#"><i class="fa fa-bookmark-o"></i> Bookmark</a>
                                </div>-->
                                <div class="read-more">
                                    <a href="{{ $une->link}}" title="{{ $une->name }}"><i class="fa fa-angle-right"></i> Détails</a>
                                </div>

                            </figcaption>
                        </figure>
                        <h4><a href="{{ $une->link }}" title="{{ $une->name }}">{{ $une->name }}</a></h4>

                        <h5><a href="{{ url('annuaire/'.$une->section->slug) }}" title="{{ $une->section->section }}">{{ $une->section->section }}</a></h5>

                    </div> <!-- end .single-product -->
                </div>
            @endforeach
        </div>  <!-- end .row -->

        <div class="discover-more">
            <a class="btn btn-default text-center" href="{{ url('annuaire') }}" title="Annuaire entreprise guinéenne"><i class="fa fa-plus-square-o"></i>Découvrir plus</a>
        </div>
    </div>  <!-- end .container -->
</div>  <!-- end .featured-listing -->
