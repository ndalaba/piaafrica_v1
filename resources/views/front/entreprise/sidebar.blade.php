<div class="col-md-3 col-md-pull-9 category-toggle">
    <button><i class="fa fa-bars"></i></button>
    <div class="page-sidebar company-sidebar">

        <ul class="company-category nav nav-tabs home-tab" role="tablist">
            <li class="@if($response==null) active @endif">
                <a href="#company-profile" role="tab" data-toggle="tab" title="profile de {{ config('application.name')}}"><i class="fa fa-newspaper-o"></i> Profil</a>
            </li>
            @if(count($entreprise->services)>=1)
                <li>
                    <a href="#company-services" role="tab" data-toggle="tab" title="Services {{ $entreprise->name}}"><i class="fa fa-file-image-o"></i>Services</a>
                </li>
            @endif
            @if(count($entreprise->produits)>=1)
                <li>
                    <a href="#company-product" role="tab" data-toggle="tab" title="Produits {{ $entreprise->name}}"><i class="fa fa-cubes"></i>Produits/Réalisations</a>
                </li>
            @endif
            @if(count($articles)>=1)
                <li>
                    <a href="{{ url('actualites/'.$entreprise->slug) }}" title="Actualités {{ $entreprise->name}}"><i class="fa fa-keyboard-o"></i>Actualites</a>
                </li>
            @endif

            @if(filter_var($entreprise->about->facebook, FILTER_VALIDATE_URL) && $entreprise->une )
                <li>
                    <a href="#facebook" role="tab" data-toggle="tab"><i class="fa fa-facebook"></i>Facebook</a>
                </li>
            @endif

            <li class="@if($response!=null) active @endif">
                <a href="#company-contact" role="tab" data-toggle="tab"><i class="fa fa-envelope-o"></i>Contact</a>
            </li>
        </ul>

        <div class="own-company">
            <a href="{{ url('nous-contacter') }}"><i class="fa fa-question-circle"></i>C'est votre entreprise?</a>
        </div>

        @include('front.entreprise.contact')

        @if(count($entreprise->partenaires))
        <div class="square-button">
            <h2>Nos partenaires</h2>
            @foreach($entreprise->partenaires as $p)
                <a href="{{ $p->lien }}" target="_blank" title="{{$p->partenaire}}"><img src="{{asset('uploads/entreprises/partenaires/'.$p->logo)}}" alt="{{ $p->partenaire }}" style="width: 125px;padding: 5px;"></a>
            @endforeach
        </div>
        @else
            @include('front.inc.pub-square')
        @endif
        <!-- end .sqare-button -->

    </div>
    <!-- end .page-sidebar -->
</div>
