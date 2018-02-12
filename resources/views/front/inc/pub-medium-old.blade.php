<div class="medium-rectangle">
    @if($pubs['medium']!=null)
        <a href="{{$pubs['medium']->lien}}" target="_blank"><img src="{{asset('uploads/pub/'.$pubs['medium']->image)}}" alt="{{$pubs['medium']->titre}}" style="width: 300px;"></a>
    @endif
</div>