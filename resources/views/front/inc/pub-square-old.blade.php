<div class="square-button">
    @foreach($pubs['squares'] as $sq)
        <a href="{{$sq->lien}}" target="_blank"><img src="{{asset('uploads/pub/'.$sq->image)}}" alt="{{$sq->titre}}" style="width: 125px; height: 125px"></a>
    @endforeach
</div>