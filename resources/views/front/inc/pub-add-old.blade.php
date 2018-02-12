<div class="advertisement">
    <p>Advertisement</p>
    @if($pubs['wide']->titre!=null)
        <a href="{{$pubs['wide']->lien}}" target="_blank">
            <img src="{{ asset('uploads/pub/'.$pubs['wide']->image)}}" alt="{{$pubs['wide']->titre}}">
        </a>
    @endif
</div>