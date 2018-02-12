<section id="footer">
    <footer>
        <div class="container">
            <div class="row">
                <div class="row">
                    <div class="col-md-4 col-sm-8">
                        <div class="widget">
                            <h4>A PROPOS DE MAAKITI</h4>

                            <p>Maakiti.com part d'une idée simple : la bonne affaire est au coin de la rue ! Simple, rapide et efficace; vous y trouvez tout ce que vous cherchez.</p>

                            <p>
                                Maakiti.com, une expertise en matière de petites annonces près de chez vous et à travers toute la Région !
                                Maakiti.com est une propriété de
                                <a href="http://www.guinee-webdev.com"><span class="col">Guinee-Webdev</span>
                                </a> une société de droit guinéen spécialisée dans la création de site internet et application web.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-8">
                        <div class="widget">
                            <h4>Annonce à la une</h4>
                            @foreach($unes as $une)
                                <div class="footer-img">
                                    <a href="{{ url('annonce/'.$une->typeannonce.'/'.$une->categorie->slug.'/'.$une->slug.'?a='.$une->id) }}" title="{{ $une->titre.' '.$une->prix.' '.$une->monnaie }}">
                                        <img src="{{asset('uploads/images/'.$une->principale)}}" alt="{{ $une->titre.' '.$une->prix.' '.$une->monnaie }}" style="width: 100px"></a>
                                    <a href="{{ url('annonce/'.$une->typeannonce.'/'.$une->categorie->slug.'/'.$une->slug.'?a='.$une->id) }}" title="{{ $une->titre.' '.$une->prix.' '.$une->monnaie }}" class="footer-img-hover"><span>{{ \App\Http\Models\Help::toMoney($une->prix,$une->monnaie) }}</span></a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-8">
                        <div class="widget">
                            <h4>Dernières</h4>
                            @foreach($latests as $latest)
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-xs-4 latest">
                                        <div class="footer-img">
                                            <img src="{{asset('uploads/images/'.$latest->principale)}}" alt="{{ $latest->titre.' '.$latest->prix.' '.$latest->monnaie }}">
                                        </div>
                                    </div>

                                    <div class="col-md-8 col-xs-8 col-sm-8">
                                        <a href="{{ url('annonce/'.$latest->typeannonce.'/'.$latest->categorie->slug.'/'.$latest->slug.'?a='.$latest->id) }}">{{ str_limit($latest->titre,40,'.')}}</a>
                                        <ul>
                                            <li>{{ \App\Http\Models\Help::toMoney($latest->prix,$latest->monnaie) }}</li>
                                            <li>{!! str_limit($latest->description,70,'...') !!}</li>
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- <div class="col-md-3 col-sm-6">
                         <div class="widget">
                             <h4>NEWSLETTER</h4>
                             <p class="sign">Lorem ipsum dolor sit amet sectetuer in adipiscing elit sed diam...</p>
                             <p class="sign">Sign up for the newsletter !</p>
                             <form method="post">
                                 <input type="email" name="email" placeholder="Your email address...">
                                 <input type="submit" name="submit" value="sign-up">
                             </form>
                         </div>
                     </div>-->
                </div>
                @foreach($sections as $section)
                    <!-- <div class="col-md-3 col-sm-6 masonry" >
                        <div class="widget">
                            <h4>{{$section->section}}</h4>
                            <ul>
                                @foreach($section->categories as $cat)
                                    <li><a href="{{ url('categories/'.$cat->slug) }}">{{ $cat->categorie }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>-->
                @endforeach
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="copyright text-center">
                        <p>@ Tous droits reservés. {{ date('Y') }} - Par
                            <a class="col" href="http://www.guinee-webdev.com">Guinee-webdev</a></p>
                    </div>
                </div>
            </div>
        </div>
        <a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>
    </footer>
</section>
<!--google analitic -->
<script type="text/javascript">

    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-36357264-2']);
    _gaq.push(['_trackPageview']);

    (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();

</script>
<!--google analitic -->