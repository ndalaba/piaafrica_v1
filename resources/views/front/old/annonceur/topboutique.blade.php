<div class="side-widget">
    <h4 class="inner-heading">Top Boutiques</h4>
    @foreach($boutiques as $boutique)
        @if($boutique->annonceur!=null) <!-- Les boutiques publies -->
        <div class="sidebar-latest-ad">
            <div class="row">
                <div class="col-sm-4">
                    <img src="{{ asset('images') }}/side-latest-ad-img3_03.png" alt="logo {{$boutique->annonceur->titre }}">
                </div>
                <div class="col-sm-8">
                    <p>
                        <a href="{{ url('boutiques/'.$boutique->annonceur->slug) }}" class="col">{{ $boutique->annonceur->titre }}</a>
                    </p>

                    <p>{!! str_limit($boutique->annonceur->description,100) !!}</p>
                </div>
            </div>
        </div>
        @endif
    @endforeach
</div>