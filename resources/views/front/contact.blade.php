@extends('front.layout')
@section('header')
    <div class="header-search fixed-height">
        @include('front.inc.search')

        <div class="page-heading contact-us-heading">
            <span></span> <!-- for dark-overlay on the bg -->

            <div class="container">
                <h1>Nous <span> contacter</span></h1>

                <div class="heading-link">
                    <a href="{{url('/')}}" title="Page d'accueil de {{config('application.name')}}">Accueil</a>
                    <i>/</i>
                    <a href="{{ url('nous-contacter') }}" title="Nous contacter">Contact Us</a>
                </div>

            </div>
                          <!-- END .container-->
        </div>
    </div>
    <div class="header-nav-bar">
        <div class="container">
            @include('front.inc.menu')
        </div>
        <!-- end .container -->
    </div>
@stop
@section('content')

    <div id="page-content">
        <div class="container">
            <div class="page-content">
                <div class="contact-us">
                    <div class="row">
                        <div class="col-md-6">
                            <h3><strong>Nous </strong> contacter</h3>

                            <div class="contacy-us-map-section">
                                <div id="contact_map_canvas">
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3934.9209495071063!2d-13.71269828517604!3d9.515597683797653!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xf1cd095ee6fac5d%3A0x6bce6bf9fb2a9ab!2sGUINEE-WEBDEV!5e0!3m2!1sfr!2s!4v1461599664009" width="600" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-sm-12">
                                    <h5>Détails adresse</h5>

                                    <div class="address-details clearfix">
                                        <i class="fa fa-map-marker"></i>

                                        <p>
                                            <span>A1-A2 WAQF BID Guinée</span>
                                            <span>Kaloun - Conakry</span>
                                            <span>Guinée</span>
                                        </p>
                                        <!--  <p>
                                              <span>Kipé , Carrefour Metal Guinée</span>
                                              <span>Commune de Ratoma </span>
                                              <span>Guinée</span>
                                          </p>-->
                                    </div>

                                    <div class="address-details clearfix">
                                        <i class="fa fa-phone"></i>

                                        <p>
                                            <span><strong>Office: :</strong> +224 622-912-041</span>
                                            <span><strong>Direct: :</strong> +224 621-585-748</span>
                                        </p>
                                    </div>

                                    <div class="address-details clearfix">
                                        <i class="fa fa-envelope-o"></i>

                                        <p>
                                            <span><strong>E-mail:</strong> &#099;&#111;&#110;&#116;&#097;&#099;&#116;&#064;&#112;&#105;&#097;&#097;&#102;&#114;&#105;&#099;&#097;&#046;&#099;&#111;&#109;</span>
                                            <span><span><strong>Website:</strong> www.piaafrica.com</span></span>
                                        </p>
                                    </div>

                                    <!--  <h5>Heures d'ouverture</h5>

                                      <div class="address-details clearfix">
                                          <i class="fa fa-clock-o"></i>
                                          <p>
                                              <span><strong>Lun-Ven:</strong> 8h - 17h</span>
                                          </p>
                                      </div>-->

                                </div>

                            </div>

                        </div>


                        <div class="col-md-6">
                            <div style="color: #4AB9CF;Font-weight: bold;">
                                {{ $success or '' }}
                            </div>
                            @if($errors->any())
                                <div style="color: #cf3839;margin: 25px;Font-weight: bold;">
                                    @foreach($errors->all() as $error)
                                        {{ $error }} <br/>
                                    @endforeach
                                </div>
                            @endif
                            @if(Session::has('message'))
                                <h3 style="font-size: 22px">{{ Session::get('message') }}</h3>
                            @else
                                <h3><strong>Nous</strong> écrire</h3>
                            @endif

                            <div class="contact-form">
                                <form action="{{ url('nous-contacter') }}" class="comment-form" method="post">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="text" placeholder="Votre nom et prénom" name="nom" required>
                                    <input type="email" name="email" placeholder="Adresse email" required>
                                    <!--<input type="text" placeholder="Website">-->
                                    <input type="text" name="sujet" placeholder="sujet">
                                    <textarea placeholder="Que pouvons nous faire pour vous?" name="message" required></textarea>
                                    <button class="btn btn-default" type="submit" value="Envoyer">
                                        <i class="fa fa-envelope-o"></i> Envoyer
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
