<style>.header-search .header-search-bar .keywords {
        float: left;
        width: 20%;
        height: 40px;
        margin-left: 10px;
    }

    .header-search .header-search-bar .select-location, .header-search .header-search-bar .category-search {
        float: left;
        width: 12%;
        height: 40px;
        border-left: 1px solid #aaa;
    }</style>
<div class="header-search-bar">
    <form action="{{ url('candidats/recherche') }}" method="get" id="frm_search">
        <div class="container">
            <!--<button class="toggle-btn" type="submit"><i class="fa fa-bars"></i></button>-->

            <div class="search-value">
                <div class="keywords">
                    <input type="text" class="form-control" placeholder="Mot clé" name="q" value="@if(isset($all)) {{$all['q']}} @endif">
                </div>
                <div class="select-location">
                    <select data-placeholder=" - Selectionner le genre - " name="civilite" id="civilite">
                        <option value="">Civilité</option>
                        <option value="M" @if(isset($all)) @if($all['civilite']=="M") selected @endif @endif>Monsieur</option>
                        <option value="Mme" @if(isset($all)) @if($all['civilite']=="Mme") selected @endif @endif>Madame</option>
                        <option value="Mlle" @if(isset($all)) @if($all['civilite']=="Mlle") selected @endif @endif>Mademoiselle</option>
                    </select>
                </div>
                <div class="select-location">
                    <select data-placeholder=" - Selectionner le pays - " name="pays" id="frm_search_country">
                        <option value="">Pays</option>
                        @foreach($countries as $country)
                            <option value="{{$country->slug}}" @if(isset($all)) @if($all['pays']==$country->slug) selected @endif @endif>{{$country->pays}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="select-location">
                    <select data-placeholder=" - Selectionner la ville - " name="ville" id="frm_search_ville">
                        <option value="">Ville</option>
                    </select>
                </div>
                <div class="select-location">
                    <select data-placeholder=" - Selectionner un niveau - " name="niveau">
                        <option value="">Niveau</option>
                        <option value="CAP" @if(isset($all)) @if($all['niveau']=="CAP") selected @endif @endif>CAP</option>
                        <option value="BEP" @if(isset($all)) @if($all['niveau']=="BEP") selected @endif @endif>BEP</option>
                        <option value="BAC" @if(isset($all)) @if($all['niveau']=="BAC") selected @endif @endif>BAC</option>
                        <option value="BAC+1" @if(isset($all)) @if($all['niveau']=="BAC+1") selected @endif @endif>BAC+1</option>
                        <option value="BAC+2" @if(isset($all)) @if($all['niveau']=="BAC+2") selected @endif @endif>BAC+2</option>
                        <option value="BAC+3" @if(isset($all)) @if($all['niveau']=="BAC+3") selected @endif @endif>BAC+3</option>
                        <option value="BAC+4" @if(isset($all)) @if($all['niveau']=="BAC+4") selected @endif @endif>BAC+4</option>
                        <option value="BAC+5" @if(isset($all)) @if($all['niveau']=="BAC+5") selected @endif @endif>BAC+5</option>
                        <option value="> BAC+5" @if(isset($all)) @if($all['niveau']=="> BAC+5") selected @endif @endif>&gt; BAC+5</option>
                    </select>
                </div>
                <div class="select-location">
                    <select data-placeholder=" - Selectionner une langue - " name="langue">
                        <option value="">Langue</option>
                        <option value="Anglais" @if(isset($all)) @if($all['langue']=="Anglais") selected @endif @endif>Anglais</option>
                        <option value="Français" @if(isset($all)) @if($all['langue']=="Français") selected @endif @endif>Français</option>
                        <option value="Arabe" @if(isset($all)) @if($all['langue']=="Arabe") selected @endif @endif>Arabe</option>
                        <option value="Chinois" @if(isset($all)) @if($all['langue']=="Chinois") selected @endif @endif>Chinois</option>
                        <option value="Russe" @if(isset($all)) @if($all['langue']=="Russe") selected @endif @endif>Russe</option>
                        <option value="Allemand" @if(isset($all)) @if($all['langue']=="Allemand") selected @endif @endif>Allemand</option>
                    </select>
                </div>
                <div class="category-search">
                    <select data-placeholder=" - Trier par - " name="order">
                        <option value="id DESC">Trier par</option>
                        <option value="naissance DESC">Âge décroissant</option>
                        <option value="naissance ASC">Âge croissant</option>
                        <option value="vu ASC"> Vue croissant</option>
                        <option value="vu DESC"> Vue decroissant</option>
                    </select>
                </div>
                <button class="search-btn" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>
        <!-- END .CONTAINER -->
    </form>
</div>