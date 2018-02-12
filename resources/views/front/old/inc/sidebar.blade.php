<div class="col-md-4">
    <div class="sidebar">
        <!--advertisement-->
        <div class="side-widget">
            <h4 class="inner-heading">PUBLICITÉ</h4>
            @include('front.inc.sidepub')
        </div>
        <!--end advertisement widget-->
        <div class="side-widget clearfix">
            <h4 class="inner-heading">À LA UNE</h4>
            @foreach($unes as $une)
                <div class="col-md-12 col-sm-4">
                    <div class="premium-widget">
                        <img src="{{asset('uploads/images/'.$une->principale)}}" alt="{{ $une->titre.' '.$une->prix.' '.$une->monnaie }}">
                        <a href="{{ url('annonce/'.$une->typeannonce.'/'.$une->categorie->slug.'/'.$une->slug.'?a='.$une->id) }}" title="{{ $une->titre.' '.$une->prix.' '.$une->monnaie }}" class="item-hover"><span>{{ \App\Http\Models\Help::toMoney($une->prix,$une->monnaie) }}</span></a>
                    </div>
                </div>
            @endforeach
        </div>
        <!--end premium widget-->

        <!--end latest ad widget-->
        <!--Tags-->
        <div class="side-widget">
            <h4 class="inner-heading">Catégories</h4>

            <div class="panel-group" id="accordion_reg" role="tablist" aria-multiselectable="true">
                @foreach($sections as $section)
                    <div class="ac-heading" role="tab" id="{{$section->id}}headingOne_reg">
                        <div class="category-icon-box"><i class="{{$section->faimage}}"></i></div>
                        <a role="button" data-toggle="collapse" data-parent="#accordion_reg" href="#sect{{$section->id}}" aria-expanded="false" aria-controls="sect{{$section->id}}">
                            {{$section->section}}
                        </a>
                    </div>
                    <div id="sect{{$section->id}}" class="panel-collapse collapse ac-body" role="tabpanel" aria-labelledby="{{$section->id}}headingOne_reg">
                        @foreach($section->categories as $cat)
                            <p><a href="{{url('categories/'.$cat->slug)}}">{{$cat->categorie}}</a></p>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
        <!--end tags widget-->
    </div>
</div>