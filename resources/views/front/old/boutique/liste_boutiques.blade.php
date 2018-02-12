<div class="tabbable-panel">
    @if($nbre)
        <div class="tabbable-line">
            <ul class="nav nav-tabs ">
                <li class="active"><a href="#tab_default_1" data-toggle="tab"> Toutes les boutiques </a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_default_1">
                    @foreach($boutiques as $boutique)
                        @if($boutique->annonceur!=null)
                            @include('front.boutique.boutique_block',['boutique'=>$boutique])
                        @endif
                    @endforeach
                    <div class="pagi">
                        {!! str_replace('/?', '?', $boutiques->render()) !!}
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="content-color">
            <h2>Aucune Boutique trouvée !</h2>

            <p>Si vous effectuez une recherche par mots-clés, vérifiez bien qu'il n'y a pas de faute de frappe.</p>
        </div>
    @endif
</div>
