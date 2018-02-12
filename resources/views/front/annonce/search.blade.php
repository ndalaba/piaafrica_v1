<style>.header-search .header-search-bar .keywords {float: left;width: 24%;height: 40px;margin-left: 10px; }.header-search .header-search-bar .select-location, .header-search .header-search-bar .category-search { float: left;width: 14%;height: 40px;border-left: 1px solid #aaa;}</style>
<div class="header-search-bar">
    <form action="{{ url('emplois/recherche') }}"  method="get" id="frm_search">
        <div class="container">
            <!--<button class="toggle-btn" type="submit"><i class="fa fa-bars"></i></button>-->

            <div class="search-value">
                <div class="keywords">
                    <input type="text" class="form-control" placeholder="Mot clé offre emploi" name="q" value="@if(isset($all)) {{$all['q']}} @endif">
                </div>
                <div class="select-location">
                    <select  data-placeholder=" - Selectionner le type - " name="type" id="type_id">
                        <option value="">Type</option>
                        <option value="CDI" @if(isset($all)) @if($all['type']=='CDI') selected @endif @endif>CDI</option>
                        <option value="CDD" @if(isset($all)) @if($all['type']=='CDD') selected @endif @endif>CDD</option>
                        <option value="Intérim" @if(isset($all)) @if($all['type']=='Intérim') selected @endif @endif>Intérim</option>
                        <option value="Stage" @if(isset($all)) @if($all['type']=='Stage') selected @endif @endif>Stage</option>
                        <option value="Apprentissage/Alternance" @if(isset($all)) @if($all['type']=='Apprentissage/Alternance') selected @endif @endif>Apprentissage/Alternance</option>
                        <option value="Indépendant / Freelance / Autoentrepreneur" @if(isset($all)) @if($all['type']=='Indépendant / Freelance / Autoentrepreneur') selected @endif @endif>Indépendant / Freelance / Autoentrepreneur</option>
                    </select>
                </div>
                <div class="select-location">
                    <select  data-placeholder=" - Selectionner le pays - " name="pays" id="frm_search_country">
                        <option value="">Pays</option>
                        @foreach($countries as $country)
                            <option value="{{$country->slug}}" @if(isset($all)) @if($all['pays']==$country->slug) selected @endif @endif>{{$country->pays}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="select-location">
                    <select  data-placeholder=" - Selectionner la ville - " name="ville" id="frm_search_ville">
                        <option value="">Ville</option>
                    </select>
                </div>
                <div class="select-location">
                    <select  data-placeholder=" - Selectionner une entreprise - " name="entreprise" id="frm_search_entreprise">
                        <option value="">Entreprise</option>
                    </select>
                </div>
                <div class="category-search">
                    <select  data-placeholder=" - Secteurs d'activité - " name="section">
                        <option value="">Secteurs</option>
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