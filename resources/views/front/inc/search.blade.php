<div class="header-search-bar">
    <form action="{{ url('recherche') }}"  method="get" id="frm_search">
        <div class="container">
            <!--<button class="toggle-btn" type="submit"><i class="fa fa-bars"></i></button>-->

            <div class="search-value">
                <div class="keywords">
                    <input type="text" class="form-control" placeholder="trouver une entreprise" name="q" value="@if(isset($all)) {{$all['q']}} @endif">
                </div>
                <div class="select-location">
                    <select class="" data-placeholder=" - Selectionner le pays - " name="pays" id="frm_search_country">
                        <option value="">Sélectionner un pays</option>
                        @foreach($countries as $country)
                            <option value="{{$country->slug}}" @if(isset($all)) @if($all['pays']==$country->slug) selected @endif @endif>{{$country->pays}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="select-location">
                    <select class="" data-placeholder=" - Selectionner la ville - " name="ville" id="frm_search_ville">
                        <option value="">Sélectionner une ville</option>
                        @foreach($villes as $ville)
                            <option value="{{$ville->ville}}" @if(isset($all)) @if($all['ville']==$ville->ville) selected @endif @endif>{{$ville->ville}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="category-search">
                    <select class="" data-placeholder=" - Selectionner la catégorie - " name="section">
                        <option value="">Sélectionner une catégorie</option>
                        @foreach($sections as $section)
                            <option value="{{$section->slug}}" @if(isset($all)) @if($all['section']==$section->slug) selected @endif @endif>{{$section->section}}</option>
                        @endforeach
                    </select>
                </div>

                <button class="search-btn" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>
        <!-- END .CONTAINER -->
    </form>
</div>