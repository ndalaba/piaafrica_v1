<div class="ad-detail">
    <div class="ad-detail-info clearfix">
        <p class="pull-left">TYPE:</p>

        <p class="pull-right light">{{$annonce->typeannonce}}</p>
    </div>
    <div class="ad-detail-info clearfix">
        <p class="pull-left">Date :</p>

        <p class="pull-right light">{{ \App\Http\Models\Help::afficherDateRelative($annonce->created_at) }}</p>
    </div>
    <div class="ad-detail-info clearfix">
        <p class="pull-left">Adresse :</p>

        <p class="pull-right light">{{$annonce->adresse}}</p>
    </div>
    <div class="ad-detail-info clearfix">
        <p class="pull-left">Localisation :</p>

        <p class="pull-right light">{{$annonce->ville.', '.$annonce->pays}}</p>
    </div>
    <div class="ad-detail-info clearfix">
        <p class="pull-left">Vues :</p>

        <p class="pull-right light">{{$annonce->vu}}</p>
    </div>
    <div class="ad-detail-info clearfix">
        <p>Description:</p>

        <p class="light line">
            {!! nl2br($annonce->description) !!}
        </p>
    </div>

    <div class="tags">
        <i class="fa fa-tags"></i>
        <span>Tags:</span>
        <span>{{$categorie->section->section}}, {{$categorie->categorie}}</span>
    </div>
</div>