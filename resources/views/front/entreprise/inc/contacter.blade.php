<div class="tab-pane @if($response!=null) active @endif" id="company-contact">
    <div class="company-profile company-contact">

        <h2>Nous contacter</h2>

        <div class="social-link text-right">
            <ul class="list-inline">
                <li><a href="{{$entreprise->facebook}}"><i class="fa fa-facebook"></i></a></li>
                <li><a href="{{$entreprise->facebook}}"><i class="fa fa-twitter"></i></a></li>
                <li><a href="{{$entreprise->facebook}}"><i class="fa fa-google-plus"></i></a></li>
                <li><a href="{{$entreprise->facebook}}"><i class="fa fa-linkedin"></i></a></li>
            </ul>
        </div>

        <div class="company-text">
            <p>
                <strong>Bésoin de plus d'information? Laisser nous un message.</strong>
            </p>
        </div>
        <!-- end company-text -->


        <div class="row">
            <div class="col-md-12">

                <div class="contact-map-company">
                    <div id="contact_map_canvas_one">

                    </div>
                </div>

                <h3>Addresses</h3>

                <div class="row">
                    @foreach($entreprise->adresses as $ad)
                        <div class="col-md-6">
                            <div class="address-details clearfix">
                                <i class="fa fa-map-marker"></i>

                                <p>
                                    <span>{{$ad->adresse}}</span>
                                    <span>{{$ad->ville->ville}}</span>
                                </p>
                            </div>

                            <div class="address-details clearfix">
                                <i class="fa fa-phone"></i>

                                <p>
                                    <span><strong>Phone:</strong> {{$ad->phone}}</span>
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="address-details clearfix">
                    <i class="fa fa-envelope-o"></i>

                    <p>
                        <span><strong>E-mail:</strong> {{$entreprise->email}}</span>
                        <span><span><strong>Site web:</strong> {{$entreprise->web}}</span></span>
                    </p>
                </div>

            </div>

        </div>
        <!-- end .row -->

        <h3>Nous écrire</h3>
        @if($response!=null)
            @if($response['type']=="success")
                <div class="alert alert-success" style=" font-weight: bold; color: green; text-align: center;">
                    <p>{{$response['message']}}</p>
                </div>
            @endif
            @include('admin.errors')
        @endif
        <form method="post" action="{{url('message-entreprise/'.$entreprise->slug)}}" class="comment-form">
            <input type="hidden" value="{{ csrf_token() }}" name="_token"/>
            <input type="hidden" value="{{$entreprise->id}}" name="id"/>

            <div class="row">
                <div class="col-md-4">
                    <input type="text" placeholder="Nom *" required name="name">
                </div>

                <div class="col-md-4">
                    <input type="email" placeholder="Email *" required name="email">
                </div>

                <div class="col-md-4">
                    <input type="text" placeholder="sujet" name="sujet" required>
                </div>
            </div>

            <textarea placeholder="Vos commentaires...." required name="message"></textarea>

            <button type="submit" class="btn btn-default">
                <i class="fa fa-envelope-o"></i> Envoyer
            </button>
        </form>

    </div>
</div>