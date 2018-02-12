<div class="tabbable-panel">
    @if(count($toutes))
        <div class="tabbable-line">
            <ul class="nav nav-tabs ">
                <li class="active"><a href="#tab_default_1" data-toggle="tab"> Toutes les annonces </a></li>
                <li><a href="#tab_default_2" data-toggle="tab"> Particuliers </a></li>
                <li><a href="#tab_default_3" data-toggle="tab"> Professionnels </a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_default_1">
                    @foreach($toutes as $annonce)
                        @include('front.annonce.annonce_block',['annonce'=>$annonce])
                    @endforeach
                    <div class="pagi">
                        {!! str_replace('/?', '?', $toutes->render()) !!}
                    </div>
                </div>
                <div class="tab-pane" id="tab_default_2">
                    @foreach($particuliers as $annonce)
                        @include('front.annonce.annonce_block',['annonce'=>$annonce])
                    @endforeach
                    <div class="pagi">
                        {!! str_replace('/?', '?', $particuliers->render()) !!}
                    </div>
                </div>
                <div class="tab-pane" id="tab_default_3">
                    @foreach($pros as $annonce)
                        @include('front.annonce.annonce_block',['annonce'=>$annonce])
                    @endforeach
                    <div class="pagi">
                        {!! str_replace('/?', '?', $pros->render()) !!}
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="content-color">
            <h2>Aucune annonce trouvée !</h2>

            <p>Si vous effectuez une recherche par mots-clés, vérifiez bien qu'il n'y a pas de faute de frappe.</p>
        </div>

    @endif
</div>
