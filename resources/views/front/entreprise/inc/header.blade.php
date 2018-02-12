<div class="company-heading-view">
    <div class="container">
        <div class="button-content">
            <button class="general-view-btn active"><i class="fa fa-newspaper-o"></i><span>Général</span>
            </button>
            @if(!empty($entreprise->map) )
                <!--<button class="map-view-btn"><i class="fa fa-map-marker"></i><span>Map</span></button>-->
          @endif
        <!--<button class="male-view-btn"><i class="fa fa-male"></i><span>Street</span></button>-->
        </div>
    </div>

    <div class="company-slider-content" style="width: 100%">

        <div class="general-view" style="width: 100%;  @if(!empty($entreprise->image)) background-image: url('{{$entreprise->principaleImagelink}}') @endif">
            <span></span> <!-- for dark-overlay on the bg -->
            <div class="container">
                @if($entreprise->logo!=null && $entreprise->id!=30)
                    <div class="logo-image">
                        <img src="{{ $entreprise->imagelink }}" alt="{{$entreprise->name}}">
                    </div>
                @endif
                <h1 @if($entreprise->id==30) style="top: 387px;text-align: center" @endif>{{$entreprise->name}}</h1>
            </div>
        </div>
        <!-- END .general-view -->

        <!--<div class="company-map-view">
            <div id="company_map_canvas">

            </div>
        </div>-->

        <!--<div class="company-map-street">
            <div id="company_map_canvas_street"></div>
        </div>-->

    </div>

</div>
