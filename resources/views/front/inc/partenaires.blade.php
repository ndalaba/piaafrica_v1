<!-- OUR PARTNER SLIDER BEGIN -->
<div class="our-partners">
    <div class="container">
        <h4>Nos partenaires</h4>

        <div id="partners-slider" class="owl-carousel owl-theme">
            @foreach($partenaires as $p)
                <div class="item">
                    <a href="{{$p->lien}}" target="_blank" title="{{$p->partenaire}}"><img src="{{ asset('uploads/pub/'.$p->image)}}" alt="{{$p->partenaire}}"></a></div>
            @endforeach
        </div>
    </div>
</div>
<!-- END OUR PARTNER SLIDER -->
