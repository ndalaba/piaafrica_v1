<section id="searchBar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form method="get" action="{{ url('boutiques/recherche') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token()}}">
                    <input class="keyword" type="text" name="q" placeholder="Que recherchez-vous ?">

                    <div class="label">
                        <select class="select" name="cat">
                            <option value="">Secteur d'activité</option>
                            @foreach($sections as $section)
                                <option value="{{$section->id}}">{{ $section->section }}</option>
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
                    <button type="submit" name="submit" class="search-btn" value="Rechercher">Rechercher</button>
                </form>
            </div>
        </div>
    </div>
</section> <!--end search bar-->
