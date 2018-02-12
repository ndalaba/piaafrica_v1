<div class="author-detail">
    <div class="row">
        <div class="col-sm-4">
            <div class="author-avatar">
                <img src="{{ asset('uploads/logos/'.$annonce->user->annonceur->logo) }}" alt="{{$annonce->user->annonceur->titre}}">
            </div>
            <div class="author-name">
                <p>{{$annonce->user->name}}</p>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="author-detail-right">
                <div class="author-info">
                    <i class="fa fa-map-marker"></i>
                    <p><!--Address: -->{{$annonce->user->annonceur->adresse.', '.$annonce->user->annonceur->ville.', '.$annonce->user->annonceur->pays}}, </p>
                </div>
                <div class="author-info">
                    <i class="fa fa-phone"></i>
                    <p><!--Phone: -->{{$annonce->user->phone}}</p>
                </div>
                <div class="author-info">
                    <i class="fa fa-globe"></i>
                    <p><!--Website: --><a class="col" href="http://{{$annonce->user->annonceur->web}}" target="_blank"> {{$annonce->user->annonceur->web}} </a></p>
                </div>
            </div>
        </div>
    </div>
</div>