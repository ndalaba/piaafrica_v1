<div id="form" style="margin: 0px 0px 30px 0px;">
    <h4 class="inner-heading">Envoyer un mail à {{$annonce->user->name}}</h4>

    <h5>Rédiger votre message</h5>

    <p>Pensez à indiquer vos coordonnées téléphoniques pour que l'annonceur puisse vous contacter facilement. Tout démarchage publicitaire ou spamming sera éliminé.</p>

    <div class="alert alert-warning" role="alert">
        <strong>Attention :</strong> Soyez attentifs ! Assurez-vous de ne pas être victime d'une tentative d'escroquerie .
        <a href="{{url('regles-generales')}}" target="_blank">Conditions générales d'utilisation</a>
    </div>
    @if(!is_null($success))
        <div class="alert alert-success">
            <p>{{$success}}</p>
        </div>
    @endif
    @include('admin.errors')
    <form method="post" action="{{url('annonce/message')}}">
        <input type="hidden" value="{{ csrf_token() }}" name="_token"/>
        <input type="hidden" value="{{$annonce->user->id}}" name="annonceur_id"/>
        <input type="hidden" value="{{$annonce->id}}" name="id"/>

        <div class="col-sm-12 input-pad">
            <span class="fa fa-user form-control-feedback"></span>
            <input class="form-control" type="text" name="name" placeholder="votre nom" required="">

        </div>
        <div class="col-sm-6 input-pad">
            <span class="fa fa-envelope form-control-feedback"></span>
            <input class="form-control" type="email" name="email" placeholder="adresse email" required="">
        </div>
        <div class="col-sm-6 input-pad">
            <span class="fa fa-phone form-control-feedback"></span>
            <input class="form-control" type="text" name="phone" placeholder="numero de téléphone">
        </div>
        <div class="col-sm-12 padding-control">
            <span class="fa fa-book form-control-feedback"></span>
            <input class="form-control" type="text" name="sujet" placeholder="sujet" required="" value="Annonce maakiti: {{$annonce->titre}}">
        </div>
        <div class="col-sm-12 padding-control">
            <textarea class="form-control" name="message"></textarea>
        </div>

        <input type="submit" value="Envoyer" name="submit">
    </form>
</div>