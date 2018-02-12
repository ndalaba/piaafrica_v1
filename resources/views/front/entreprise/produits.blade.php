<div class="tab-pane" id="company-product">
    <div class="company-product">

        <h2 class="text-uppercase mb30">Nos réalisations</h2>

        <div class="row">
            @foreach($entreprise->produits as $prod)
                <div class="col-sm-4 col-xs-6">
                    <div class="single-product">
                        <figure>

                            <img src="{{$prod->imagelink}}" alt="{{$prod->produit}}">

                            <figcaption>
                                <div class="read-more">
                                    <a href="{{$prod->link}}" title="En savoir plus sur {{$prod->produit}}"><i class="fa fa-angle-right"></i> Détails</a>
                                </div>
                            </figcaption>
                        </figure>

                        <h4><a href="{{ $prod->link }}" title="En savoir plus sur {{$prod->produit}}">{{$prod->produit}}</a></h4>
                    </div>
                    <!-- end .single-product -->
                </div>
            @endforeach
        </div>
    </div>
</div>
