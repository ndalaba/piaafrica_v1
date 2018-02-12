<div class="tab-pane" id="company-services">

    <div class="company-events">

        <h2 class="mb30">Nos services</h2>
        @foreach($entreprise->services as $service)
            <div class="post-with-image">
                <h3 class="title"><a href="{{ $service->link }}" title="{{$service->service}}">{{$service->service}}</a></h3>

                <p class="post">
                    {!! nl2br(str_limit($service->description,200)) !!}
                </p>
            </div>
        @endforeach

    </div>
    <!-- end .company-events -->
</div>
<!-- end .tab-pane -->
