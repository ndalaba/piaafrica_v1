<div class="recently-added">
    <h2>Top entreprises</h2>
    @foreach($unes as $une)
    <div class="single-product">
        <figure>
            <img src="{{ $une->imagelink}}" alt="{{$une->name}}">
        </figure>

        <h4><a href="{{ $une->link }}" title="{{ $une->name }}">{{ $une->name }}</a></h4>

        <p>{{ $une->adresses[0]->adresse }}.</p>

        <a class="read-more" href="{{$une->link}}" title="En savoir plus sur {{ $une->name }} "><i class="fa fa-angle-right"></i>Détail</a>

    </div>
    @endforeach

</div>
