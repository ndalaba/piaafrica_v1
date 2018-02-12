@extends('front.layout')
@section('title') @parent | Nous contacter @stop
@section('content')

<section id="page-head">
    <div class="container">
        <div class="row col-md-12">
            <div class="page-heading">
                <h1>Nous contacter</h1>
            </div>
        </div>
    </div>
</section>
<section id="detail">
    <div class="container">
        <div class="row">
          <div class="page-content">
            <p><b>Besoin d'aide ?</b><br><br>
                Si vous rencontrez des difficultés, consultez notre <a class="col" href="{{url('faq')}}">page</a> qui vous aidera à trouver les réponses aux questions les plus fréquemment posées.
                Si vous ne trouvez pas la réponse à votre question dans nos pages d'aide, vous pouvez nous contacter<br><br>

                <b>Professionnels ?</b><br><br>
                Vous souhaitez nous confier vos campagnes de communication ou devenir partenaire de Maakiti.com?
                Annonceurs, centrales d'achat, nous vous proposons de construire la campagne de communication qui vous convient.

                Pour en savoir plus, contactez notre régie Internet par mail ci-dessus et choisissez le sujet "Partenariats et Publicité"
            </p>
          </div>
        </div>
        <div class="row">
            <div id="form">
              <div style="color: #4AB9CF;margin: 25px;Font-weight: bold;">
                  {{ $success or '' }}
              </div>
              @if($errors->any())
                  <div style="color: #cf3839;margin: 25px;Font-weight: bold;" >
                      @foreach($errors->all() as $error)
                          {{ $error }} <br/>
                      @endforeach
                  </div>
              @endif
                <form method="post" lpformnum="1" _lpchecked="1" action="{{ url('nous-contacter') }}">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="col-md-12 col-sm-6 input-pad">
                        <span class="fa fa-text-height form-control-feedback"></span>
                        <input class="form-control" type="text" name="nom" placeholder="Votre nom et prénom" required>
                    </div>
                    <div class="col-md-12 col-sm-6 input-pad">
                        <span class="fa fa-folder form-control-feedback"></span>
                        <input class="form-control" type="email" name="email" placeholder="Adresse email" required>
                    </div>
                    <div class="col-md-12 col-sm-6 input-pad">
                        <span class="fa fa-book form-control-feedback"></span>
                        <input class="form-control" type="text" name="sujet" placeholder="sujet" required>
                    </div>
                    <div class="col-md-12 col-sm-6 input-pad">
                        <textarea class="form-control" name="message" required></textarea>
                    </div>
                    <input class="input-pad" type="submit" value="Envoyer" name="submit">
                </form>
            </div>
        </div>
    </div>
</section>
@stop
