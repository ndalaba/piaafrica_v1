<div class="contact-details">
    <h2>Détails</h2>

    <ul class="list-unstyled">
        <li>
            <strong>Nom: </strong>
            <span>{{$entreprise->name}}</span>
        </li>

        <li>
            <strong>Adresse: </strong>
            <div>
                {{$entreprise->adresses[0]->adresse}}, {{$entreprise->adresses[0]->ville->ville}}
            </div>
        </li>
        <li>
            <strong>Phone: </strong>
            <span>{{$entreprise->adresses[0]->phone}}</span>
        </li>

        <li>
            <strong>Site web: </strong>
            <span><a href="{{$entreprise->web}}" target="_blank">{{$entreprise->web}}</a></span>
        </li>

        <li>
            <strong>E-mail: </strong>
            <span>{!! \App\Http\Models\Help::hide_email($entreprise->email) !!}</span>
        </li>

    </ul>
</div>
