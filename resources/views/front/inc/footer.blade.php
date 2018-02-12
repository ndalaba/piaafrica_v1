@include('front.inc.like')
<footer id="footer">
    <div class="main-footer">

        <div class="container">
            <div class="row">

                <div class="col-md-3 col-sm-6">
                    <div class="about-globo">
                        <h3>{{ config('application.name') }}</h3>

                        <div class="footer-logo">
                            <a href="{{ url('/') }}"><img src="{{ asset('images/logo.png') }}" alt="logo {{ config('application.name') }}" style="width: 160px"></a>
                            <span></span> <!-- This content for overlay effect -->
                        </div>

                        <p><a href="{{ url('qui-sommes-nous') }}">{{ config('application.description') }}</a></p>

                    </div> <!-- End .about-globo -->
                </div> <!-- end Grid layout-->

                <div class="col-md-3 col-sm-6">
                    <h3>Derniers articles</h3>
                    @foreach($lasts as $last)
                    <div class="latest-post clearfix">
                        <div class="post-image">
                            @if(!empty($last->image))
                            <img src="{{asset('uploads/articles/'. $last->image) }}" alt="{{$last->titre}}">
                            @endif
                            <p><span>{{ \App\Http\Models\Help::jourMois($last->created_at)['jour'] }}</span>{{ \App\Http\Models\Help::jourMois($last->created_at)['mois'] }}</p>
                        </div>

                        <h4><a href="{{url('actualites/'.$last->section->slug.'/'.$last->slug)}}">{{$last->titre}}</a></h4>

                        <p>{{ str_limit(strip_tags($last->contenu),40)}}</p>
                    </div>
                    @endforeach
                </div> <!-- end Grid layout-->

                <div class="col-md-3 col-sm-6 clearfix">
                    <div class="popular-categories">
                        <h3>Top catégories</h3>
                        <ul>
                            @foreach($populaires as $pop)
                            <li><a href="{{ url('annuaire/'.$pop->slug) }}"><i class="fa {{$pop->faimage}}"></i>{{$pop->section}}</a></li>
                           @endforeach
                        </ul>
                    </div> <!-- end .popular-categories-->
                </div> <!-- end Grid layout-->

                <div class="col-md-3 col-sm-6">
                    <div class="newsletter">
                        <h3>Newsletter</h3>

                        <form action="{{ url('newsletter') }}" id="newsletter">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" class="token" />
                            <input type="email" placeholder="Adresse email" name="email" id="news_email" required>
                            <button type="submit"><i class="fa fa-plus"></i></button>
                        </form>

                        <h3>Rester en contact</h3>

                        <ul class="list-inline">
                            <li><a href="https://www.facebook.com/PIA-Africa-1238895382848814/"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="https://twitter.com/pia_africa"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="https://plus.google.com/109675597617359280146/"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                        <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FPIA-Africa-1238895382848814%2F&tabs=timeline&width=270&height=130&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=false&appId=1621017894862178" width="270" height="130" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
                    </div> <!-- end .newsletter-->

                </div> <!-- end Grid layout-->
            </div> <!-- end .row -->
        </div> <!-- end .container -->
    </div> <!-- end .main-footer -->

    <div class="copyright">
        <div class="container">
            <p>Copyright {{ date('Y') }} &copy; {{ config('application.name') }}. Tout droit reservé. Par  <a href="http://www.piaafrica.com">{{ config('application.name') }}</a></p>

            <ul class="list-inline">
                <li><a href="{{ url('/') }}">Accueil</a></li>
                <li><a href="{{ url('qui-sommes-nous') }}">Qui sommes nous?</a></li>
                <li><a href="{{url('faq')}}">FAQ</a></li>
                <li><a href="{{ url('regles-generales') }}">Mentions légales</a></li>
                <li><a href="{{ url('nous-contacter') }}">Contact</a></li>
            </ul>
        </div> <!-- END .container -->
    </div> <!-- end .copyright-->
</footer> <!-- end #footer -->

<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-36357264-5', 'auto');
    ga('send', 'pageview');

</script>
