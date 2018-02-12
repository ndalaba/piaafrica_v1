<div class="recently-added">
    <h2>Top offres d'emploi</h2>
    @foreach($unes as $une)
        <div class="single-product">
            <h4><a href="{{$une->link}}" title="{{ $une->titre }}">{{ $une->titre }}</a></h4>
            <h6>
                {{ \App\Http\Models\Help::timestampToDate($une->created_at) }} |
                {{$une->type}} |
                <a href="{{ url('emploi/'.$une->section->slug) }}" title="{{ $une->section->section }}">{{ $une->section->section }}</a> |
                {{$une->ville->ville}}-{{$une->ville->country->pays}}
            </h6>

            <p>{{ str_limit($une->description,200) }}</p>
        </div>
    @endforeach

</div>
