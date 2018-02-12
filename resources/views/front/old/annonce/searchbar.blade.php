<section id="searchBar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form method="get" action="{{ url('annonces/recherche') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token()}}">
                    <input class="keyword" type="text" name="q" placeholder="Que recherchez-vous ?">

                    <div class="label">
                        <select class="select" name="cat">
                            <option value="">Toutes catégories</option>
                            @foreach($sections as $section)
                                <optgroup label="{{ $section->section }}">
                                    @foreach($section->categories as $cat)
                                        <option value="{{$cat->id}}">{{ $cat->categorie }}</option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                    </div>
                    <div class="label">
                        <select class="select" name="ville">
                            <option value="">Ville</option>
                            @foreach($villes as $ville)
                                <option value="{{$ville->ville}}">{{$ville->ville}}</option>
                            @endforeach
                        </select>
                    </div>
                    @if(isset($recherche))
                        <div class="label">
                            <select class="select" name="type">
                                <option value="">Type annonce</option>
                                <option value="0">Offre</option>
                                <option value="1">Demande</option>
                            </select>
                        </div>

                        <input type="text" class="keyword price" name="min" placeholder="prix minimum"/>
                        <input type="text" class="keyword price" name="max" placeholder="prix maximum"/>
                        <div class="label">
                            <select class="select" name="monnaie">
                                <option value="">Monnaie</option>
                                <option value="GNF">GNF</option>
                                <option value="FCFA">FCFA</option>
                                <option value="&#x24;">&#x24;</option>
                                <option value="&#128;">&#128;</option>
                            </select>
                        </div>
                        @endif
                                <!-- <a href="#" class="location">
                       <i class="fa fa fa-location-arrow "></i>
                   </a>
                 <div class="location-tip">
                       <span class="location-range">499 km</span>
                   </div>-->
                        <button type="submit" name="submit" class="search-btn" value="Rechercher">Rechercher</button>
                </form>
            </div>
        </div>
    </div>
</section> <!--end search bar-->
